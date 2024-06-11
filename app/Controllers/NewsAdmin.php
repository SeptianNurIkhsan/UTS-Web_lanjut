<?php namespace App\Controllers;

use \App\Models\NewsModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class NewsAdmin extends BaseController
{
    public function index()
    {
        $news = new NewsModel();
        $data['newses'] = $news->findAll();
        echo view('admin_list_news', $data);
    }

    //--------------------------------------------------------------------------

    public function preview($id)
    {
        $news = new NewsModel();
        $data['news'] = $news->find($id);

        if (!$data['news']) {
            throw PageNotFoundException::forPageNotFound();
        }
        echo view('news_detail', $data);
    }

    //--------------------------------------------------------------------------

    public function create()
    {
        // lakukan validasi
        $validation = \Config\Services::validation();
        $validation->setRules([
            'title' => 'required',
            'content' => 'required',
            'status' => 'required'
        ]);

        $isDataValid = $validation->withRequest($this->request)->run();

        // jika data valid, simpan ke database
        if ($isDataValid) {
            $news = new NewsModel();
            $news->save([
                "title" => (string)$this->request->getPost('title'),
                "content" => (string)$this->request->getPost('content'),
                "status" => (string)$this->request->getPost('status'),
                "slug" => url_title((string)$this->request->getPost('title'), '-', TRUE)
            ]);
            return redirect()->to('admin/news');
        }

        // tampilkan form create
        echo view('admin_create_news');
    }

    //--------------------------------------------------------------------------

    public function edit($id)
    {
        $news = new NewsModel();
        $data['news'] = $news->find($id);

        if (!$data['news']) {
            throw PageNotFoundException::forPageNotFound();
        }

        // lakukan validasi data artikel
        $validation = \Config\Services::validation();
        $validation->setRules([
            'title' => 'required',
            'content' => 'required',
            'status' => 'required'
        ]);

        $isDataValid = $validation->withRequest($this->request)->run();

        // jika data valid, maka simpan ke database
        if ($isDataValid) {
            $updateData = [
                "title" => $this->request->getPost('title'),
                "content" => $this->request->getPost('content'),
                "status" => $this->request->getPost('status')
            ];

            $news->update($id, (object)$updateData);
            return redirect()->to('admin/news');
        }

        // tampilkan form edit
        echo view('admin_edit_news', $data);
    }


    //--------------------------------------------------------------------------

    public function delete($id)
    {
        $news = new NewsModel();
        $news->delete($id);
        return redirect()->to('admin/news');
    }
}