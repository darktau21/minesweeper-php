<?php

namespace models;

class CellModel
{
    public $x;
    public $y;
    public $has_bomb;
    public $is_opened = false;
    public $is_marked = false;
    public $is_exploded = false;
    public $bombs_around_count = 0;
    private $field;

    public function __construct($x, $y, $has_bomb, FieldModel $field)
    {
        $this->x = $x;
        $this->y = $y;
        $this->field = $field;
        $this->has_bomb = $has_bomb;

        if (!$has_bomb) {
            $this->calc_bombs_around();
        }
    }

    public function open() {
        if ($this->is_opened) return;
        if ($this->has_bomb) {
            $this->explode();
            return;
        }

        $this->is_opened = true;
        if ($this->is_marked) $this->toggle_mark();

        if (!$this->bombs_around_count) {
            $this->open_neighbours();
        }
    }

    public function toggle_mark() {
        if ($this->is_opened) return 'not changed';

        if ($this->is_marked) {
            $this->is_marked = false;
            return 'unmarked';
        } else {
            $this->is_marked = true;
            return 'marked';
        }
    }

    private function calc_bombs_around()
    {
        for ($row = $this->y - 1; $row <= $this->y + 1; $row++) {
            for ($column = $this->x - 1; $column <= $this->x + 1; $column++) {
                if ($this->is_bomb_cords($column, $row)) $this->bombs_around_count++;
            }
        }
    }

    private function is_bomb_cords($x, $y)
    {
        return $this->field->grid[$y][$x]->has_bomb;
    }

    public function open_neighbours() {
        $this->_open_neighbours($this->x, $this->y);
    }

    private function _open_neighbours($trigger_x_cord, $trigger_y_cord) {
        if (is_null($this->field->grid[$trigger_y_cord][$trigger_x_cord])) return;
        if ($this->field->grid[$trigger_y_cord][$trigger_x_cord]->bombs_around_count) {
            $this->field->grid[$trigger_y_cord][$trigger_x_cord]->open();
            return;
        }
        for ($row = $trigger_y_cord - 1; $row <= $trigger_y_cord + 1; $row++) {
            for ($column = $trigger_x_cord - 1; $column <= $trigger_x_cord + 1; $column++) {
                if ($this->field->grid[$row][$column]->has_bomb ||
                    is_null($this->field->grid[$row][$column]) ||
                    $this->field->grid[$row][$column]->is_opened ||
                    $this->field->grid[$row][$column]->is_marked
                ) continue;
                $this->field->grid[$row][$column]->open();
                $this->field->grid[$row][$column]->open_neighbours();
            }
        }
    }

    private function explode()
    {
        foreach ($this->field->grid as $row) {
            foreach ($row as $cell) {
                if ($cell->has_bomb) {
                    $cell->is_exploded = true;
                    $cell->is_opened = true;
                    $cell->is_marked = false;
                }

                $this->field->state = 'lose';
            }
        }
    }
}