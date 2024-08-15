<?php

namespace App\DataCollector;

use Symfony\Bundle\FrameworkBundle\DataCollector\AbstractDataCollector;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\VarDumper\Cloner\Data;

class AnotherDataCollector extends AbstractDataCollector
{

    public function collect(Request $request, Response $response, ?\Throwable $exception = null): void
    {
        $this->data = [
            'method' => $request->getMethod(),
            'acceptable_content_types' => $request->getAcceptableContentTypes(),
        ];
    }

    public function getMethod(): string
    {
        return $this->data['method'];
    }

    public function getAcceptableContentTypes(): array
    {
        return $this->data['acceptable_content_types'];
    }

    public function getSomeObject(): Data
    {
        // use the cloneVar() method to dump collected data in the profiler
        return $this->cloneVar($this->data['method']);
    }

    public static function getTemplate(): ?string
    {
        return 'collector/another.html.twig';
    }
}