<?php

namespace controllers;

use core\Controller;
use models\FieldModel;

class GameController extends Controller
{
    private $field;
    private $get;
    private $post;
    public function index($get, $post, $param)
    {
        $this->get = $get;
        $this->post = $post;

        $this->init();
        $this->start();
        $this->open_handler();
        $this->mark_handler();

        $this->render('game', [
            'title' => $this->get_title(),
            'field' => $this->field
        ]);
    }

    private function init() {
        if (is_null($_SESSION['game'])) {
            $_SESSION['game'] = new FieldModel(9, 10);
        }
        $this->field = $_SESSION['game'];
    }

    private function start() {
        if ($this->field->state === 'not started' &&
            isset($this->post['open_cell_x']) &&
            isset($this->post['open_cell_y'])
        ) {
            $this->field->start([
                'x' => $this->post['open_cell_x'],
                'y' => $this->post['open_cell_y'],
            ]);
        }
    }

    private function open_handler() {
        if ($this->field->state === 'in game' &&
            isset($this->post['open_cell_x']) &&
            isset($this->post['open_cell_y'])) {
            $this->field->open_cell($this->post['open_cell_x'], $this->post['open_cell_y']);
        }
    }

    private function mark_handler() {
        if ($this->field->state === 'in game' &&
            isset($this->post['mark_cell_x']) &&
            isset($this->post['mark_cell_y'])) {
            $this->field->toggle_mark_cell($this->post['mark_cell_x'], $this->post['mark_cell_y']);
        }
    }

    private function get_title() {
        switch ($this->field->state) {
            case 'not started':
                return 'Не начато';
            case 'in game':
                return 'Игра';
            case 'lose':
                return 'Поражение';
            case 'win':
                return 'Победа';
        }
    }
}