<?php

namespace Omniflow\\Model;

class Task
{
    public string $id;
    public string $title;
    public ?string $notes = null;
    public ?string $dueDate = null;
}
