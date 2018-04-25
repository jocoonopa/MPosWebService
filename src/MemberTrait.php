<?php

namespace jocoonopa\MPosWebService;

/**
 * Member relate methods
 */
trait MemberTrait
{
    /**
     * Paginate results of fetchMembers()
     * 
     * @param  array $data
     * @return array
     */
    public function getMembersPagination(array $data)
    {
        /**
         * @var integer
         */
        $count = $this->fetchMembersCount($data);

        /**
         * @var integer
         */
        $pageSize = array_get($data, 'pageSize', 10);

        return [
            'data' => $this->fetchMembers($data),

            'meta' => [
                'current_page' => (int) array_get($data, 'currentPage', 1),
                'last_page' => floor($count/$pageSize),
                'per_page' => (int) array_get($data, 'pageSize', 10),
                'total' => $count,
            ],
        ];
    }

    /**
     * 取得指定條件下 member 的數量，搭配 query 方法可以達到 pagination 效果
     *
     * @param  array $data
     * @return integer
     */
    public function fetchMembersCount(array $data)
    {
        $response = $this->curl(
            $data,

            "{$this->getApiUrl()}/member/count"
        );

        if (isset($response['data'])) {
            return (int) array_get($response, 'data')->noOfShoppers;
        }

        return 0;
    }

    /**
     * 取得指定條件下的 members data
     * 
     * @return array
     */
    public function fetchMembers(array $data)
    {        
        $response = $this->curl(
            $data,
            
            "{$this->getApiUrl()}/member/query"
        );

        return array_get($response, 'data');
    }

    /**
     * 取得可用的 fields
     * 
     * @return array
     */
    public function fetchFields()
    {
        $response = $this->curl(
            [],
            
            "{$this->getApiUrl()}/member/fields"
        );

        return array_get($response, 'data');
    }

    /**
     * fetchDistricts 
     * 
     * @return array
     */
    public function fetchDistricts()
    {
        $response = $this->curl(
            [],
            
            "{$this->getApiUrl()}/member/district/query"
        );

        return array_get($response, 'data');
    }

    /**
     * fetchMemberAddressbook
     *
     * @param  array $data [example: {"keywords": "1"}]
     * @return array
     */
    public function fetchMemberAddressbook(array $data)
    {
        $response = $this->curl(
            $data,
            
            "{$this->getApiUrl()}/member/addressbook/query"
        );

        return array_get($response, 'data');
    }
}