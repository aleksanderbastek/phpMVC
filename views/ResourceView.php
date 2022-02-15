<?php

class ResourceView {
  private $path;

  public function __construct($path) {
    $this->path = $path;
  }

  public function render() {
    $file = "..{$this->path}";
	$contentType = mime_content_type($file);

	if (substr($file, -4) == ".css") {
	  $contentType = "text/css";
	}

	if (substr($file, -3) == ".js") {
	  $contentType = "text/javascript";
	}

	$this->serveStaticFile($file, array(
		'headers' => array(
			'Content-Type' => $contentType
		)
	));
  }

	private function serveStaticFile($path, $options = array()) {
		$path = realpath($path);
		if (is_file($path)) {
			if(session_id())
				session_write_close();

			header_remove();
			set_time_limit(0);
			$size = filesize($path);
			$lastModifiedTime = filemtime($path);
			$fp = @fopen($path, 'rb');
			$range = array(0, $size - 1);

			header('Last-Modified: ' . gmdate("D, d M Y H:i:s", $lastModifiedTime)." GMT");
			if (( ! empty($_SERVER['HTTP_IF_MODIFIED_SINCE']) && strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) == $lastModifiedTime ) ) {
				header("HTTP/1.1 304 Not Modified", true, 304);
				return true;
			}

			if (isset($_SERVER['HTTP_RANGE'])) {
				if(substr($_SERVER['HTTP_RANGE'], 0, 6) != 'bytes=') {
					header('HTTP/1.1 416 Requested Range Not Satisfiable', true, 416);
					header('Content-Range: bytes */' . $size);
					return false;
				}

				$ranges = explode(',', substr($_SERVER['HTTP_RANGE'], 6));
				$range = explode('-', $ranges[0]);

				if ($range[0] === '') $range[0] = 0;
				if ($range[1] === '') $range[1] = $size - 1;

				if (($range[0] >= 0) && ($range[1] <= $size - 1) && ($range[0] <= $range[1])) {
					header('HTTP/1.1 206 Partial Content', true, 206);
					header('Content-Range: bytes ' . sprintf('%u-%u/%u', $range[0], $range[1], $size));
				}
				else {
					header('HTTP/1.1 416 Requested Range Not Satisfiable', true, 416);
					header('Content-Range: bytes */' . $size);
					return false;
				}
			}

			$contentLength = $range[1] - $range[0] + 1;

			$headers = array(
				'Accept-Ranges' => 'bytes',
				'Content-Length' => $contentLength,
				'Content-Type' => 'application/octet-stream',
			);

			if(!empty($options['headers'])) {
				$headers = array_merge($headers, $options['headers']);
			}
			foreach($headers as $k=>$v) {
				header("$k: $v", true);
			}

			if ($range[0] > 0) {
				fseek($fp, $range[0]);
			}
			$sentSize = 0;
			while (!feof($fp) && (connection_status() === CONNECTION_NORMAL)) {
				$readingSize = $contentLength - $sentSize;
				$readingSize = min($readingSize, 512 * 1024);
				if($readingSize <= 0) break;

				$data = fread($fp, $readingSize);
				if(!$data) break;
				$sentSize += strlen($data);
				echo $data;
				flush();
			}

			fclose($fp);
			return true;
		}
		else {
			header('HTTP/1.1 404 Not Found', true, 404);
			return false;
		}
	}
}