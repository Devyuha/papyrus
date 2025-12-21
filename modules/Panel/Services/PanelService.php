<?php

    namespace Module\Panel\Services;

    use Exception;
    use Module\Main\ServiceResult;
    use Module\Panel\Repositories\UserRepository;
    use Papyrus\Http\Password;

    class PanelService {
        private UserRepository $userRepository;

        public function __construct() {
            $this->userRepository = new UserRepository();
        }
        
        public function updateProfile($request) {
            $result = new ServiceResult();

            try {
                $id = auth()->user("id");
                $query = $this->userRepository->updateUserProfile($id, $request);

                $result->setSuccess(true);
                $result->setMessage("Profile has been updated.");
            } catch(Exception $e) {
                $result->setSuccess(false);
                $result->setMessage($e->getMessage());
            }

            return $result;
        }

        public function updatePassword($request) {
            $result = new ServiceResult();

            try {
                $old_password = $request->sanitizeInput("old_password");
                $new_password = $request->sanitizeInput("new_password");
                $is_password_verified = $this->verifyPassword($old_password);
                if($is_password_verified) {
                    $hash_password = Password::hash($new_password);
                    $this->userRepository->updatePassword($hash_password);

                    $result->setSuccess(true);
                    $result->setMessage("Password has been updated.");
                } else {
                    $result->setSuccess(false);
                    $result->setMessage("Old password is invalid");
                }
            } catch(Exception $e) {
                $result->setSuccess(false);
                $result->setMessage($e->getMessage());
            }

            return $result;
        }

        private function verifyPassword($password) {
            $old_password = $this->userRepository->getPassword();
            return Password::verify($password, $old_password);
        }
    }
