<?php


namespace App\Services;


use App\Exceptions\UrlNotFoundException;
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

    /**
     * @param $url_id
     * @return Url
     * @throws UrlNotFoundException
     */
    public function find($url_id): Url
    {
        $url = $this->urlRepository->findById($url_id);
        if($url === null){
            throw new UrlNotFoundException("Url record not found");
        }
        return $url;
    }

    /**
     * @param array $data
     * @return Url
     */
    public function update(array $data): Url
    {
        return $this->urlRepository->update($data);
    }
}
