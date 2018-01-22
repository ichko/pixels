<?php
namespace Services;

class AuthService
{
    public function __construct($db, $session_service, $navigation_service)
    {
        $this->db = $db;
        $this->session_service = $session_service;
        $this->navigation_service = $navigation_service;
    }

    public function get_user_id($username, $password)
    {
        return $this->db->query("
            SELECT `id` FROM `users` WHERE
            `name`= :username AND
            `pass_hash` = :pass_hash
        ")->bind_all([
            'username' => $username,
            'pass_hash' => $this->hash_password($password),
        ])->execute()->fetch()['id'];
    }

    public function is_user_registered($username, $email)
    {
        return $this->db->query("
            SELECT COUNT(*) AS `num_rows` FROM `users` WHERE
            `name`= :username OR
            `email` = :email
        ")->bind_all([
            'username' => $username,
            'email' => $email,
        ])->execute()->fetch()['num_rows'];
    }

    public function login($user_id)
    {
        $this->session_service->set('IS_LOGGED', true);
        $this->session_service->set('USER_ID', $user_id);
    }

    public function assert_logged()
    {
        if (!$this->is_logged()) {
            $this->navigation_service->navigate_to('/');
        }
    }

    public function assert_not_logged()
    {
        if ($this->is_logged()) {
            $this->navigation_service->navigate_to('/');
        }
    }

    public function get_user($user_id)
    {
        return $this->db->query("
            SELECT `name`, `email`, `id` FROM `users`
            WHERE `id` = :id
        ")->bind_all(['id' => $user_id])->execute()->fetch();
    }

    public function get_logged_user()
    {
        return $this->get_user($this->session_service->get('USER_ID'));
    }

    public function register($username, $password, $email)
    {
        $user_id = $this->db->query("
            INSERT INTO `users` (`name`, `email`, `pass_hash`)
            VALUES (:username, :email, :pass_hash);"
        )->bind_all([
            'username' => $username,
            'email' => $email,
            'pass_hash' => $this->hash_password($password),
        ])->execute()->get_last_id();
        $this->login($user_id);
    }

    public function logout()
    {
        $this->session_service->destroy();
        $this->navigation_service->navigate_to('/');
    }

    public function is_logged()
    {
        return $this->session_service->get('IS_LOGGED');
    }

    private function hash_password($password)
    {
        return hash('sha256', $password);
    }
}
