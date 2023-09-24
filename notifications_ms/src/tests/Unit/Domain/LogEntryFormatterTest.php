<?php

namespace Tests\Unit\Domain;

use Domain\Notification;
use Domain\LogEntryFormatter;
use PHPUnit\Framework\TestCase;

class LogEntryFormatterTest extends TestCase
{
    private LogEntryFormatter $formatter;

    protected function setUp(): void
    {
        $this->formatter = new LogEntryFormatter();
    }

    public function test_timestamps_are_in_formatted_entry(): void
    {
        $notification = new Notification(['key' => 'value']);
        $formattedEntry = $this->formatter->format($notification);

        $expectedFormat = <<<REGEX
        ENTRY: \d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}
        json: {"key":"value"}
        created_ts: \d+\.\d+
        END ENTRY\n
        REGEX;

        $this->assertMatchesFormat($expectedFormat, $formattedEntry);
    }

    private function assertMatchesFormat($expectedFormat, $actual)
    {
        $lines = array_filter(explode(PHP_EOL, $actual), fn ($v) => !empty($v));
        $formatLines = array_filter(explode(PHP_EOL, $expectedFormat), fn ($v) => !empty($v));

        $this->assertEquals(count($formatLines), count($lines));
        foreach ($formatLines as $index => $format) {
            $this->assertMatchesRegularExpression("/{$format}/", $lines[$index]);
        }
    }
}