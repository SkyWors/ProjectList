<?php

namespace App\Models\Entities;

class Project {
	private string $uid;
	private string $name;
	private ?string $description = null;
	private ?string $illustration = null;

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

	/**
	 * Get the value of description
	 *
	 * @return string | null
	 */
	public function getDescription(): string | null {
		return $this->description;
	}

	/**
	 * Set the value of description
	 *
	 * @param string $description
	 *
	 * @return self
	 */
	public function setDescription(string $description): self {
		$this->description = $description;

		return $this;
	}

	/**
	 * Get the value of illustration
	 *
	 * @return string | null
	 */
	public function getIllustration(): string | null {
		return $this->illustration;
	}

	/**
	 * Set the value of illustration
	 *
	 * @param string $illustration
	 *
	 * @return self
	 */
	public function setIllustration(string $illustration): self {
		$this->illustration = $illustration;

		return $this;
	}
}
