<?php declare(strict_types=1);

class mydeflate extends php_user_filter
{
	public function filter($in, $out, &$consumed, bool $closing): int
	{
		if (!$closing)
		{
			$data = '';
			while ($bucket = stream_bucket_make_writeable($in))
			{
				$consumed += $bucket->datalen;
				$data     .= $bucket->data;
			}

			$bucket = stream_bucket_new($this->stream, gzdeflate($data, 9, ZLIB_ENCODING_RAW));
			stream_bucket_append($out, $bucket);
		}

		return PSFS_PASS_ON;
	}
}
stream_filter_register('zlib.deflate', mydeflate::class);