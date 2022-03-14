<?php

    namespace App\Repository;

    interface TagRepositoryInterface extends EloquentRepositoryInterface
    {
        /**
         * @param array $payload
         * @param int $gigId
         * @return bool
         */
        public function TagMassInsertion(array $payload, int $gigId): bool;

    }

?>
