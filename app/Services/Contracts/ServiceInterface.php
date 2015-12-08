<?php

namespace CodeDelivery\Services\Contracts;

interface ServiceInterface
{
    /**
     * @param array $data
     * @return array|mixed
     */
    public function create(array $data);

    /**
     * @param array $data
     * @param $id
     * @return array|mixed
     */
    public function update(array $data, $id);


    /**
     * @param $id
     * @return array
     */
    public function destroy($id);

}
