<?php
namespace classes;

class order
{
	public $username;
	public $lastname;
	public $email;
	public $phone;
	public $conf;
	public $pay;
	public $message;
	public $agree;

	protected static $confies = [
		1 => 'Бизнес',
		2 => 'Технологии',
		3 => 'Реклама и Маркетинг',
	];

	protected static $payment = [
		1 => 'WebMoney',
		2 => 'Яндекс.Деньги',
		3 => 'PayPal',
		4 => 'кредитная карта',
	];

	protected $errors;
	protected $id;
	protected $date;

	public function validate(){
		$errors=[];

		if (empty($this->username))
			$errors['username'] = 'Username is required!';
		else if (strlen($this->username) < 3)
			$errors['username'] = 'Username must be at least 3 symbols or more';
		else if (strlen($this->username) > 100)
			$errors['username'] = 'username must be less than 100 characters';
		else if (!preg_match("/^[А-Яё][а-яё]+?$/", $this->username))
			$errors['username'] = 'username must begin with capital letter; username must be in russian';


		if (empty($this->lastname))
			$errors['lastname'] = 'lastname is required!';
		else if (strlen($this->lastname) < 3)
			$errors['lastname'] = 'lastname must be at least 3 symbols or more';
		else if (strlen($this->lastname) > 100)
			$errors['lastname'] = 'lastname must be less than 100 characters';
		else if (!preg_match('/^[А-Яё][а-яё]+?$/', subject))
			$errors['lastname'] = 'lastname must begin with a capital letter; lastname must be in russian';

		if (empty($this->email))
			$errors['email'] = 'email is required!';
		else if (strlen($this->email) < 3)
			$errors['email'] = 'email must be at least 3 symbols or more';
		else if (strlen($this->email) > 100)
			$errors['email'] = 'email must be less than 100 characters';
		else if (!preg_match('/^[a-zA-Z0-9]+\@[a-zA-Z]{2,63}\.[a-zA-Z]{2,}$/', $this->email))
			$errors['email'] = 'email must be entered properly';


		if (empty($this->phone))
			$errors['phone'] = 'phone is required!';
		else if (!preg_match('/^\+7\s?\d{3}\s?\d{3}\-?\d{2}\-?\d{2}$/', $this->phone))
			$errors['phone'] = 'phone is not matching the needed pattern!';


		if (empty($this->conf))
		{
			$errors['conf'] = 'conf is required!';
		} 

		if (empty($this->pay))
		{
			$errors['pay'] = 'pay is required!';
		} 


		if (empty($this->message))
		{
			$errors['message'] = 'message is required!';
		}
		else if (strlen($this->message) < 3)
		{
			$errors['message'] = 'message must be at least 3 symbols or more';
		}
		else if (strlen($this->message) > 100)
		{
			$errors['message'] = 'message must be less than 100 characters';
		}


		if (empty($this->agree))
		{
			$errors['agree'] = 'you must agree with the policy!';
		}

		$this->errors = $errors;

		return !$this->errors;
	}

	public function getErrors()
	{
		return $this->errors;
	}

	public function getConfies()
	{
		return static::$confies;
	} 

	public function getPayment()
	{
		return static::$payment;
	}
	public function fill($data)
	{
		$this->username = trim(strip_tags(array_get($data,'username')));
		$this->lastname = trim(strip_tags(array_get($data,'lastname')));
		$this->email = trim(strip_tags(array_get($data,'email')));
		$this->phone = trim(strip_tags(array_get($data,'phone')));
		$this->conf = trim(strip_tags(array_get($data,'conf')));
		$this->pay = trim(strip_tags(array_get($data,'pay')));
		$this->message = trim(strip_tags(array_get($data,'message')));
		$this->post = trim(strip_tags(array_get($data,'post')));
		$this->agree = trim(strip_tags(array_get($data,'agree')));
	}

	public function save()
	{

		$content = [];
		$content[] = uniqid();
		$content[] = date('Y-m-d H:i:s');
		$content[] = $this->username;
		$content[] = $this->lastname;
		$content[] = $this->email;
		$content[]= preg_replace('/^\+7\s?(\d{3})\s?(\d{3})\-?(\d{2})\-?(\d{2})$/', '+7 $1 $2-$3-$4',$this->phone);
		$content[]=$this->conf;
		$content[]=$this->pay;
		$content[] = str_replace(PHP_EOL, ' ', $this->message);
		$content[]= $this->post;

		$filename= 'data.txt';

		$content = implode('||', $content) . "\n\r";

		file_put_contents($filename, $content, FILE_APPEND);

      // $successMessage = 'Thank you the data has been saved!';
		return true;
	}

	public function getData($file)
	{
			$contents = file_get_contents('data.txt');
			$contents=trim($contents);

			$items=explode("\n", $contents);

			$data=[];

			foreach ($items as $item) {

				$item= trim($item);
				$cols =explode('||', $item);

				$data[$cols[0]] = [
					'id' => $cols[0],
					'date' => $cols[1],
					'username' => $cols[2],
					'lastname' => $cols[3],
					'email'=> $cols[4],
					'phone'=>$cols[5],
					'conf' => $this->getConfies()[$cols[6]],
					'pay' => $this->getPayment()[$cols[7]],
					'message' => $cols[8],
					'post' => $cols[9],
				];
			}
			return $data;
	}
}
