<?php

namespace PromClient\Metrics;


abstract class AbstractPrometheus
{
    /**
     * @var string[]
     */
    protected array $label_names = ['env'];

    /**
     * @var array
     */
    protected array $label_values = ['dev'];

    /**
     * @param string[] $labels
     */
    public function __construct(array $labels)
    {
        $this->label_values[0] = getenv('ENVIRONMENT');
        foreach ($labels as $name => $value) {
            if (!is_string($name) || !is_string($value)) {
                throw new \InvalidArgumentException('Invalid value');
            }
            $this->label_names[] = $name;
            $this->label_values[] = $value;
        }
    }
}
