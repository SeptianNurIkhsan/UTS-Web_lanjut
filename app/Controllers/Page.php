<?php namespace App\Controllers;

class Page extends BaseController
{
	public function about()
	{
		echo view('about');
	}
    public function contact()
	{
		$data['name'] = "User";
		echo view("contact", $data);
	}
    
    public function faqs()
	{
		// membuat data untuk dikirim ke view
		$data['data_faqs'] = [
			[
				'question' => 'Apa itu Codeigniter?',
				'answer' => 'Codeigniter adalah framework PHP untuk membuat website'
			],
			[
				'question' => 'Siapa yang membuat Codeiginter?',
				'answer' => 'Codeigniter awalnya dibuat oleh Ellislab'
			],
			[
				'question' => 'Codeigniter versi berapakah yang terbaru?',
				'answer' => 'Codeigniter terbaru adalah versi 4'
			]
		];

		// load view dengan data
		echo view("faqs", $data);
	}

    public function tos()
    {
        echo view ('Halaman Term of Service');
    }

}