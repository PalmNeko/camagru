<?php

namespace PalmNeko\Camagru\Presentation\Http;

class Headers {

    private array $headers = [];

    public function append(string $name, string $value) {
        $name = strtolower($name);
        if (key_exists($name, $this->headers))
            $this->headers[$name] .= ", $value";
        else
            $this->headers[$name] = $value;
    }

    public function get(string $name) : string | null {
        $name = strtolower($name);
        return key_exists($name, $this->headers) ? $this->headers[$name] : null;
    }

    public function has(string $name) : bool {
        $name = strtolower($name);
        return key_exists($name, $this->headers);
    }

    public function set(string $name, string $value) {
        $name = strtolower($name);
        $this->headers[$name] = $value;
    }

    public function delete(string $name) {
        $name = strtolower($name);
        unset($this->headers[$name]);
    }

    public function entities(): \Generator {
        foreach ($this->headers as $name => $value)
            yield $name => $value;
    }
}
