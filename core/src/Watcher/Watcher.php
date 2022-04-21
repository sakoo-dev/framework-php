<?php

namespace Core\Watcher;

use Core\Utilities\Locker;

class Watcher
{
	private $inotify;
	private array $targetFiles = [];

	public function __construct()
	{
		$this->inotify = inotify_init();
	}

	public function watch($finder, callable $callback): self
	{
		$finder = $finder->files();
		foreach ($finder as $file) {
			$this->watchFile($file->getRealPath(), $callback, $file->getMTime());
		}
		return $this;
	}

	private function watchFile($path, $callback, $mtime): int
	{
		$wd = inotify_add_watch($this->inotify, $path, IN_ALL_EVENTS);

		$this->targetFiles[$wd] = [
			'path' => $path,
			'mtime' => $mtime,
			'callback' => $callback,
			'locker' => getNew(Locker::class),
		];

		return $wd;
	}

	public function run(): void
	{
		while (true) {
			$events = inotify_read($this->inotify);
			foreach ($events as $event) {
				$this->eventCall($event);
			}
		}
	}

	private function eventCall($event): void
	{
		$event['name'] = $this->targetFiles[$event['wd']]['path'];

		switch ($event['mask']) {
			case IN_MODIFY:
				$this->fileModified($event);
			break;
			case IN_DELETE_SELF:
				$this->fileDeleted($event);
			break;
		}
	}

	private function fileModified($event): void
	{
		$file = &$this->targetFiles[$event['wd']];

		if ($file['locker']->isLocked()) {
			return;
		}

		clearstatcache();

		if ($file['mtime'] < filemtime($file['path'])) {
			$file['locker']->lock();
			$file['mtime'] = filemtime($file['path']);
			$file['callback']($event, $file['locker']);
		}
	}

	private function fileDeleted($event): void
	{
		inotify_rm_watch($this->inotify, $event['wd']);
		unset($this->targetFiles[$event['wd']]);
	}
}
