<?php

namespace App\Filament\Widgets;

use App\Models\Cppt;
use App\Models\Diagnose;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Carbon\Carbon;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\ChartWidget\Concerns\HasFiltersSchema;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Contracts\Support\Htmlable;

class CpptChart extends ChartWidget
{
    use HasWidgetShield, HasFiltersSchema;

    public function getHeading(): string | Htmlable | null
    {
        return 'Grafik CPPT per bulan di tahun ' . ($this->filters['year'] ?? date('Y'));
    }

    public function filtersSchema(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('diagnose')
                ->label('Diagnosa')
                ->options(Diagnose::query()->pluck('code', 'id'))
                ->native(false),
            Select::make('year')
                ->label('Tahun')
                ->options(
                    collect(range(now()->year, now()->year - 5))
                        ->mapWithKeys(fn ($year) => [$year => $year])
                        ->toArray()
                )
                ->default(now()->year)
                ->native(false)
        ]);
    }

    protected function getData(): array
    {
        $year = $this->filters['year'] ?? date('Y');
        $diagnose = $this->filters['diagnose'] ?? null;

        $start = Carbon::create($year)->startOfYear();
        $end   = Carbon::create($year)->endOfYear();

        $data = Trend::query(
                Cppt::whereYear('created_at', $year)->when($diagnose, fn ($query) => $query->where('diagnose_id', $diagnose))
            )
            ->between(
                start: $start,
                end: $end,
            )
            ->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah CPPT',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => Carbon::createFromFormat('Y-m', $value->date)->translatedFormat('F')),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
