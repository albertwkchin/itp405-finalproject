<?php


class YummlyTest extends TestCase {

    public function tearDown()
    {
        Mockery::close();
    }


    public function testSearchPullsFromCache()
    {
        $json = '{"total": 0, "recipes": []}';
        $client = Mockery::mock('App\Services\Client');

        $cache = Mockery::mock('Illuminate\Cache\Repository');
        $cache->shouldReceive('has')->with('chicken')->andReturn(true);
        $cache->shouldReceive('get')->with('chicken')->andReturn($json);


        $rt = new App\Services\YummlyRequest($cache, $client);
        $results = $rt->cacheSearch('chicken');

        $this->assertEquals($results, json_decode($json));
    }

    public function testSearchPullsFromApiAndStoresInCache()
    {
        $client = Mockery::mock('App\Services\Client');
        $client->shouldReceive('get')
            ->with('http://yummly.com/api?q=chicken')
            ->andReturn('{"total": 2, "recipes": []}');

        $cache = Mockery::mock('Illuminate\Cache\Repository');
        $cache->shouldReceive('has')->with('chicken')->andReturn(false);
        $cache->shouldReceive('put')
            ->once()
            ->with('chicken', '{"total": 2, "recipes": []}', 60);

        $rt = new App\Services\YummlyRequest($cache, $client);
        $results = $rt->cacheSearch('chicken');
        $this->assertEquals($results, json_decode('{"total": 2, "recipes": []}'));
    }

}