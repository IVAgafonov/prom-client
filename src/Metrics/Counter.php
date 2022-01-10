<?php

namespace PromClient\Metrics;


class Counter extends AbstractPrometheus
{
    /**
     * @var \Prometheus\Counter
     */
    private \Prometheus\Counter $counter;

    /**
     * @param string $metric_name
     * @param string[] $labels
     */
    public function __construct(string $metric_name, array $labels)
    {
        parent::__construct($labels);
        $registry = CollectorRegistry::getDefault();
        $this->counter = $registry->getOrRegisterCounter(
            'promonavi',
            $metric_name.'_counter',
            '',
            $this->label_names
        );
    }

    /**
     * @param int $by
     */
    public function inc(int $by = 1): void
    {
        $this->counter->incBy($by, $this->label_values);
    }
}
