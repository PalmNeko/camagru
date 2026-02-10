<?php


namespace PalmNeko\Camagru\Presentation\Http;

use PalmNeko\Camagru\Presentation\Http\URL\URLValidator;
use PalmNeko\Camagru\Presentation\Exception\UsageException;

/**
 * URLクラスです。以下のURLの一部のプロパティ、メソッドを実装しています。
 * Specificationをみたしていることは保証しておらず、表面実装になっています。
 * https://developer.mozilla.org/ja/docs/Web/API/URL
 */
class URL
{
    public string $protocol {
        set(string $value) {
            if ($value === '')
                return ;
            if ($value[-1] !== ':')
                $value .= ':';
            $this->protocol = $value;
        }
    }

    public string $username;
    public string $password;
    public string $hostname;

    public string $port {
        set(string $value) {
            if (ctype_digit($value))
                $this->port = strval(intval($value));
        }
    }

    public string $pathname {
        set(string $value) {
            if (strlen($value) == 0 || $value[0] !== '/')
                $value = "/$value";
            $this->pathname = $value;
        }
    }

    public string $search {
        set(string $value) {
            $this->search = self::normalizePrefix($value, '?');
        }
    }

    public string $hash {
        set(string $value) {
            $this->hash = self::normalizePrefix($value, '#');
        }
    }

    public string $href {
        get {
            return $this->__toString();
        }
        set(string $value) {
            $this->set_url(($value));
        }
    }

    public function __construct(string $url) {
        $this->set_url($url);
        if (empty($this->protocol)) {
            throw new UsageException('Invalid URL');
        }
    }

    public function __toString(): string {
        return
            $this->protocol .
            '//' .
            $this->username .
            $this->password .
            $this->hostname .
            $this->port .
            $this->pathname .
            $this->search .
            $this->hash
        ;
    }

    public static function parse(string $url): self
    {
        return new self($url);
    }

    private function set_url(string $url) {
        $parsed = parse_url($url);
        if (! $parsed) {
            throw new UsageException('Invalid URL');
        }
        $this->protocol = $parsed['scheme'] ?? '';
        $this->username = $parsed['user'] ?? '';
        $this->password = $parsed['pass'] ?? '';
        $this->hostname = $parsed['host'] ?? '';
        $this->port = $parsed['port'] ?? '';
        $this->pathname = $parsed['path'] ?? '';
        $this->search = $parsed['query'] ?? '';
        $this->hash = $parsed['fragment'] ?? '';
    }

    /**
     * searchとhashで使用している。
     * 先頭にprefixが無ければ足す。prefixしかないなら空文字列を返す。
     * @param string $value
     * @param string $prefix
     * @return string
     */
    private static function normalizePrefix(string $value, string $prefix) : string
    {
        if ($value === '' || $prefix === $value)
            return '';
        if (! str_starts_with($value, $prefix))
            $value = "$prefix$value";
        return $value;
    }
}
