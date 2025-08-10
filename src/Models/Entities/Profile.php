<?php

namespace App\Models\Entities;

class Profile {
	private string $uid;
	private ?User $creator;
	private ?string $name = null;

	/**
	 * Get the value of uid
	 *
	 * @return string
	 */
	public function getUid(): string {
		return $this->uid;
	}

	/**
	 * Set the value of uid
	 *
	 * @param string $uid
	 *
	 * @return self
	 */
	public function setUid(string $uid): self {
		$this->uid = $uid;

		return $this;
	}

	/**
	 * Get the value of creator
	 *
	 * @return User
	 */
	public function getCreator(): User {
		return $this->creator;
	}

	/**
	 * Set the value of creator
	 *
	 * @param User $creator
	 *
	 * @return self
	 */
	public function setCreator(User $creator): self {
		$this->creator = $creator;

		return $this;
	}

	/**
	 * Get the value of name
	 *
	 * @return string
	 */
	public function getName(): string {
		return $this->name;
	}

	/**
	 * Set the value of name
	 *
	 * @param string $name
	 *
	 * @return self
	 */
	public function setName(string $name): self {
		$this->name = $name;

		return $this;
	}
}
