<?php

namespace models;

class FieldModel
{
    public $grid = [];
    public $state = 'not started';
    public $size;
    public $bombs_count;
    public $first_opened_cell_cords;
    public $marked_cells_count = 0;

    public function __construct($size, $bombs_count)
    {
        $this->size = $size;
        $this->bombs_count = $bombs_count;
    }

    public function start($first_opened_cell)
    {
        $this->first_opened_cell_cords = $first_opened_cell;
        $this->state = 'in game';
        $this->generate_grid();
    }

    public function open_cell($x, $y)
    {
        $this->grid[$y][$x]->open();
        $this->check_win();
    }

    public function toggle_mark_cell($x, $y)
    {
        if (is_null($this->grid[$y][$x])) return;
        switch ($this->grid[$y][$x]->toggle_mark()) {
            case 'marked':
                $this->marked_cells_count++;
                break;
            case 'unmarked':
                $this->marked_cells_count--;
                break;
        }
        $this->check_win();
    }

    private function generate_grid()
    {
        $this->generate_bombs();

        for ($y = 0; $y < $this->size; $y++) {
            for ($x = 0; $x < $this->size; $x++) {
                if (!$this->is_cell_exists($x, $y)) {
                    $this->grid[$y][$x] = new CellModel($x, $y, false, $this);
                }
            }
        }

        $this->grid[$this->first_opened_cell_cords['y']][$this->first_opened_cell_cords['x']]->open();
    }

    private function generate_bombs()
    {
        $generated_bombs_count = 0;
        while ($generated_bombs_count < $this->bombs_count) {
            $cords = [
                'x' => $this->generate_random_cord(),
                'y' => $this->generate_random_cord()
            ];

            if (
                ((int)$this->first_opened_cell_cords['x'] === $cords['x'] &&
                    (int)$this->first_opened_cell_cords['y'] === $cords['y']) ||
                isset($this->grid[$cords['y']][$cords['x']])
            ) {
                continue;
            }

            $this->grid[$cords['y']][$cords['x']] = new CellModel($cords['x'], $cords['y'], true, $this);
            $generated_bombs_count++;
        }
    }

    private function generate_random_cord()
    {
        return mt_rand(0, $this->size - 1);
    }

    private function is_cell_exists($x, $y)
    {
        return isset($this->grid[$y][$x]);
    }

    private function check_win()
    {
        $marked_bombs_count = 0;
        $marked_cells_count = 0;
        $opened_cells_count = 0;

        foreach ($this->grid as $row) {
            foreach ($row as $cell) {
                if ($cell->has_bomb && $cell->is_marked) $marked_bombs_count++;
                if (!$cell->has_bomb && $cell->is_marked) $marked_cells_count++;
                if ($cell->is_opened) $opened_cells_count++;
            }
        }

        if (
            ($marked_cells_count === 0 && $marked_bombs_count === $this->bombs_count) ||
            $opened_cells_count === $this->size ** 2 - $this->bombs_count
        ) {
            $this->state = 'win';
        }
    }
}