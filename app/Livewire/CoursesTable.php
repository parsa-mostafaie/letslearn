<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Course;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ComponentColumn;
class CoursesTable extends DataTableComponent
{
  protected $model = Course::class;

  protected $listeners = ['courses-table-reload' => '$refresh'];

  public function builder(): \Illuminate\Database\Eloquent\Builder
  {
    return Course::latest()->with('author');
  }

  public function configure(): void
  {
    $this->setPrimaryKey('id');
  }

  public function columns(): array
  {
    return [
      Column::make("Id", "id")
        ->sortable()
        ->searchable(),
      Column::make("Title", "title")
        ->sortable()
        ->searchable(),
      Column::make("Description", "description")
        ->sortable()
        ->searchable(),
      Column::make("Author", "user_id")
        ->format(
          fn($value, $row, Column $column) => $row->author->name
        ),
      Column::make("Slug", "slug")
        ->sortable()
        ->searchable(),
      Column::make("Created at", "created_at")
        ->sortable(),
      Column::make("Updated at", "updated_at")
        ->sortable(),
      ComponentColumn::make('Actions', 'id')
        ->component('courses.actions')
        ->attributes(fn($value, Course $row) => ['course' => $value])
    ];
  }
}
