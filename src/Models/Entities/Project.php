<?php

namespace App\Models\Entities;

class Project {
	private string $uid;
	private ?User $user = null;
	private string $name;
	private ?string $description = null;
	private ?string $illustrationBlob = null;

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
	 * Get the value of user
	 *
	 * @return User
	 */
	public function getUser(): User {
		return $this->user;
	}

	/**
	 * Set the value of user
	 *
	 * @param User $user
	 *
	 * @return self
	 */
	public function setUser(User $user): self {
		$this->user = $user;

		return $this;
	}
	
	/**
	 * Get the value of name
	 *
	 * @return string
	 */
	public function getName(): string {
		return htmlspecialchars(string: $this->name);
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

	/**
	 * Get the value of description
	 *
	 * @return string | null
	 */
	public function getDescription(): string | null {
		return htmlspecialchars(string: $this->description);
	}

	/**
	 * Set the value of description
	 *
	 * @param string $description
	 *
	 * @return self
	 */
	public function setDescription(?string $description): self {
		$this->description = $description;

		return $this;
	}

	/**
	 * Get the value of illustration
	 *
	 * @return string | null
	 */
	public function getIllustrationBlob(): string | null {
		return $this->illustrationBlob;
	}

	/**
	 * Set the value of illustrationBlob
	 *
	 * @param string $illustrationBlob
	 *
	 * @return self
	 */
	public function setIllustrationBlob(?string $illustrationBlob): self {
		$this->illustrationBlob = $illustrationBlob;

		return $this;
	}
}
