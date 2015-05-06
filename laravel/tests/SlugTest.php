<?php

class SlugTest extends TestCase {

    public function testToString()
    {
        $slug = new App\Services\Slug('Learning Unit Testing with PHPUnit');
        $this->assertEquals((string)$slug, 'learning-unit-testing-with-phpunit');
    }
}