<?php

namespace PromClient\Metrics;


use PromClient\Init\PromMetricInit;
use Prometheus\CollectorRegistry;
use Prometheus\Storage\APC;

class Gauge extends AbstractPrometheus
{
    /**
     * @var \Prometheus\Gauge
     */
    private \Prometheus\Gauge $gauge;

    /**
     * @param string $metric_name
     * @param string[] $labels
     */
    public function __construct(string $metric_name, array $labels)
    {
        parent::__construct($labels);
        $registry = new CollectorRegistry(new APC());
        $this->gauge = $registry->getOrRegisterGauge(
            PromMetricInit::$namespace,
            $metric_name.'_gauge',
            '',
            $this->label_names
        );
    }

    /**
     * @param int $by
     */
    public function inc(int $by): void
    {
        $this->gauge->incBy($by, $this->label_values);
    }

    /**
     * @param int $value
     */
    public function set(int $value): void
    {
        $this->gauge->set($value, $this->label_values);
    }
}
