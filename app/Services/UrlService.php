<?php


namespace App\Services;


use App\Models\Url;
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


    /**
     * @param $data
     * @return Url
     */
    public function create($data): Url
    {
        return $this->urlRepository->create($data);
    }

    /**
     * @param $id
     * @return Url
     */
    public function delete($id): Url
    {
        return $this->urlRepository->delete($id);
    }
}
