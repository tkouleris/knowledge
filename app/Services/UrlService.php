<?php


namespace App\Services;


use App\Repositories\Contracts\IUrlRepository;

class UrlService
{
    private $urlRepository;

    /**
     * UrlService constructor.
     * @param $urlRepository
     */
    public function __construct(IUrlRepository $urlRepository)
    {
        $this->urlRepository = $urlRepository;
    }


    public function create($data)
    {
        return $this->urlRepository->create($data);
    }
}
