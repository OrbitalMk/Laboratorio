<?php

interface IModel{
    public function create();
    public function read();
    public function readById($id);
    public function delete();
    public function update();
    public function from($array);
}