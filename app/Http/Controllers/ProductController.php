<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Services\Form\FormService;
use App\Http\Services\Product\ProductServiceInterface;
use App\Http\Services\Size\SizeService;
use App\Http\Services\Theme\ThemeService;
use App\Http\Services\Type\TypeService;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    protected $productService;
    protected $typeService;
    protected $sizeService;
    protected $formService;
    protected $themeService;

    public function __construct(ProductServiceInterface $productService, TypeService $typeService, SizeService $sizeService, FormService $formService, ThemeService $themeService)
    {
        $this->productService = $productService;
        $this->typeService = $typeService;
        $this->sizeService = $sizeService;
        $this->formService = $formService;
        $this->themeService = $themeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->productService->getAll();
        return  view('admin.product.list',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = $this->typeService->getAll();
        $forms = $this->formService->getAll();
        $sizes = $this->sizeService->getAll();
        $themes = $this->themeService->getAll();
        return  view('admin.product.create',compact('forms','types', 'sizes', 'themes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $this->productService->store($request);
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->productService->findById($id);
        $types = $this->typeService->getAll();
        $forms = $this->formService->getAll();
        $sizes = $this->sizeService->getAll();
        $themes = $this->themeService->getAll();
        return  view('admin.product.edit',compact('product','types','forms','sizes','themes'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $this->productService->update($request,$id);
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->productService->destroy($id);
        return redirect()->route('product.index');
    }


}
