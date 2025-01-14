<?php

namespace App\Models\Traits;

use Hamcrest\Type\IsBoolean;
use Illuminate\Support\Facades\Cache;

trait Cacheable
{
    /**
     * Get cache.
     * 
     * @param string $cache
     * 
     * @return mixed
     */
    public function getCache(string $cache, string $default = null): mixed
    {
        return Cache::get($cache.'_'.strtolower(class_basename($this)).'_'.$this->id, $default);
    }

    /**
     * Put cache.
     * 
     * @param string $cache
     * @param mixed $value
     * @param int $ttl
     * 
     * @return mixed
     */
    public function putCache(string $cache, mixed $value, int $ttl = null): mixed
    {
        if($ttl == null)
        {
            return Cache::forever($cache.'_'.strtolower(class_basename($this)).'_'.$this->id, $value);
        }
        else
        {
            return Cache::put($cache.'_'.strtolower(class_basename($this)).'_'.$this->id, $value, $ttl);
        }
    }

    /**
     * Check if it has cache.
     * 
     * @param string $cache
     * 
     * @return mixed
     */
    public function hasCache(string $cache): mixed
    {
        return Cache::has($cache.'_'.strtolower(class_basename($this)).'_'.$this->id);
    }

    /**
     * Delete cache.
     * 
     * @param string $cache
     * 
     * @return mixed
     */
    public function forgetCache(string $cache): mixed
    {
        return Cache::forget($cache.'_'.strtolower(class_basename($this)).'_'.$this->id);
    }

    /**
     * Universal Cache
     * 
     * @param string $cache
     * 
     * @return mixed
     */
    public function cache(string $cache, mixed $value = null, mixed $ttl_or_default = null): mixed
    {
        if(is_int($ttl_or_default))
        {
            // Under Construction
        }
        return Cache::forget($cache.'_'.strtolower(class_basename($this)).'_'.$this->id);
    }
}