<?php

namespace PromClient\Metrics;


class Summary extends AbstractPrometheus
{

    /**
     * @var \Prometheus\Summary
     */
    private \Prometheus\Summary $summary;

    /**
     * @param string $metric_name
     * @param string[] $labels
     */
    public function __construct(string $metric_name, array $labels)
    {
        parent::__construct($labels);
        $registry = CollectorRegistry::getDefault();
        $this->summary = $registry->getOrRegisterSummary(
            'promonavi',
            $metric_name,
            '',
            $this->label_names,
            84600,
            [0.01, 0.05, 0.5, 0.95, 0.99]
        );
    }

    /**
     * @param int|float $value
     */
    public function observe($value): void
    {
        $this->summary->observe($value, $this->label_values);
    }
}
