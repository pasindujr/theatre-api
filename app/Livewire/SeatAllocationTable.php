<?php

namespace App\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\SeatAllocation;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;

class SeatAllocationTable extends DataTableComponent
{

    public int $eventId;
    public function builder(): Builder
    {
        return SeatAllocation::query()
            ->where('event_id', $this->eventId);
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Seat number", "seat_number")
                ->sortable(),
            BooleanColumn::make("Is reserved", "is_reserved")
                ->sortable(),
        ];
    }
}
