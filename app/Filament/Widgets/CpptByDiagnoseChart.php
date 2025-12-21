<?php

namespace App\Filament\Widgets;

use App\Models\Cppt;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\ChartWidget\Concerns\HasFiltersSchema;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\DB;

class CpptByDiagnoseChart extends ChartWidget
{
    use HasWidgetShield, HasFiltersSchema;
    
    protected ?string $heading = 'Jumlah CPPT berdasrkan diagnos';

    public function getHeading(): string | Htmlable | null
    {
        return 'Jumlah CPPT berdasrkan diagnosa tahun ' . ($this->filters['year'] ?? date('Y'));
    }

    public function filtersSchema(Schema $schema): Schema
    {
        return $schema->components([
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
        
        $data = Cppt::query()
                ->whereYear('created_at', $year)
                ->select('diagnose_id', DB::raw('count(*) as total'))
                ->with(['diagnose'])
                ->groupBy('diagnose_id')
                ->get();
        return [
            'datasets' => [
                [
                    'data' => $data->pluck('total'),
                    'backgroundColor' => $data->map(fn ($item) => $this->colorFromString($item->diagnose->code)),
                ],
            ],
            'labels' => $data->pluck('diagnose.code'),
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }

    private function colorFromString(string $value): string
    {
        return '#' . substr(md5($value), 0, 6);
    }
}
