<?php


namespace RomanPitak\Nginx\Config;


trait ScopeIterator
{
    /** @var Directive[] $directives */
    protected $directives = [];

    protected $position = 0;

    public function current()
    {
        return $this->directives[$this->position];
    }

    public function rewind()
    {
        $this->position = 0;
        return $this;
    }

    public function key() {
        return $this->position;
    }

    public function next() {
        ++$this->position;
    }

    public function valid() {
        return isset($this->directives[$this->position]);
    }

    public function empty() {
        return empty($this->directives);
    }

    public function search(callable $function) {
        $scope = new Scope();
        /** @var Directive $directive */
        foreach($this->directives as $directive) {
            $ret = call_user_func($function, $directive);
            if(!empty($ret)) {
                $scope->addDirective($directive);
            }
        }

        return $scope;
    }
}