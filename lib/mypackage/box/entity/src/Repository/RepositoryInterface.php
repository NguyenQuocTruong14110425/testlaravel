<?php namespace Box\Entity\Repository;

interface RepositoryInterface {
    /**
     * @return mixed
     */
    public function all($pagin, $lang);

    /**
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * @param $data
     * @return mixed
     */
    public function create($data);

    /**
     * @param $data
     * @return mixed
     */
    public function update($data);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * @return mixed
     */
    public function allTrash($pagin, $lang);

    /**
     * @param $id
     * @return mixed
     */
    public function trash($id, $trash);

    /**
     * @return mixed
     */
    public function withErrors();
}