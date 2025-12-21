<?php

    namespace Module\Panel\Repositories;

    use Papyrus\Database\Pdo;
    use Module\Panel\Queries\UpdateProfile;
    use Module\Panel\Queries\GetOldPassword;
    use Module\Auth\Queries\UpdatePasswordByEmail;

    class UserRepository {
        public function updateUserProfile($id, $request) {
            $query = Pdo::execute(new UpdateProfile([
                ":name" => $request->sanitizeInput("name"),
                ":email" => $request->sanitizeInput("email"),
                ":id" => $id
            ]));

            return $query;
        }

        public function getPassword() {
            $userId = auth()->user("id");
            logger()->debug("User ID :: " . $userId);
            $query = Pdo::execute(new GetOldPassword([
                ":id" => $userId
            ]));

            $password = $query->first()["password"];

            return $password;
        }

        public function updatePassword($password) {
            $email = auth()->user("email");
            return Pdo::execute(new UpdatePasswordByEmail([
                ":email" => $email,
                ":password" => $password
            ]));
        }
    }
