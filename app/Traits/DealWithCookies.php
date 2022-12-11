<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cookie;

trait DealWithCookies
{
    /**
     * add item to the cookies as json
     *
     * @param string $key
     * @param mixed $new_item
     * @return void
     */
    public function addItemToJsonCookie(string $key, mixed $new_item)
    {
        $newCooky = collect(json_decode(request()->cookie($key)));

        $newCooky->add($new_item);

        Cookie::queue("books:cart", $newCooky->toJson(), 60 * 60 * 5);

        return  $newCooky;
    }

    /**
     * get item from the cookies when it is json
     *
     * @param string $key
     * @return void
     */
    public function getItemFromJsonCookie(string $key)
    {
        return collect(json_decode(request()->cookie($key)))->toArray();
    }

    /**
     * remove item from the cookies
     *
     * @param string $key
     * @param mixed $old_item
     * @return void
     */
    public function removeItemFromJsonCookie(string $key, mixed $old_item)
    {
        $newCooky = collect(json_decode(request()->cookie($key)))->filter(fn ($el) => $el !== $old_item);

        Cookie::queue("books:cart", $newCooky->toJson(), 60 * 60 * 5);

        return  $newCooky;
    }

    /**
     * determine wether the item exists in cookie or not
     *
     * @param string $key
     * @param mixed $item
     * @return void
     */
    public function cookieHasItem(string $key, mixed $item)
    {
        return !collect(json_decode(request()->cookie($key)))->filter(fn ($el) => $el === $item)->isEmpty();
    }

    /**
     * toggle item from the cookies ,
     *
     * @param string $key
     * @param mixed $item
     * @return void
     */
    public function toggleItemInCookies(string $key, mixed $item)
    {
        if ($this->cookieHasItem($key, $item)) :

            $this->removeItemFromJsonCookie($key, $item);
            return ["attached" => [], "detached" => [$item]];

        else :

            $this->addItemToJsonCookie($key, $item);
            return  ["attached" => [$item], "detached" => []];

        endif;
    }
}
