<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Brand;
use App\Category;
use App\Color;
use App\Product;
use Validator;
use Storage;
use App\products_image;
use App\ideal;
use File;

class productcontroller extends Controller
{
	public function index()
	{
		$category = Category::where('status','y')->get();

		$color = Color::where('status','y')->get();

		$brand = Brand::where('status','y')->get();

		$ideal = Ideal::where('status','y')->get();

		return view('layout.admin.product.addproduct',['categories'=>$category,'colors'=>$color,'brands'=>$brand,'ideals'=>$ideal]);
	}

	public function insert(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'name' => 'required|unique:products',
			'UPC' => 'required|unique:products',
			'image' => 'mimes:jpg,jpeg,png|required|max:10000',
			'description' => 'required',
			'category_id' => 'required',
			'color_id' => 'required',
			'brand_id' => 'required',
			'ideal_id' => 'required',
			'price' => 'required|min:1|max:10',
			'stock' => 'required|min:1|max:10',
		]);


		if($validator->fails()) 
		{
			return Redirect('admin/product/add')->withErrors($validator);
		}

		else
		{
			$obj = new Product;

			$pic = request()->file('image')->storeAs('public/images/products/' .$request->UPC.'',"main.jpg");

			$obj->name = $request->name;
			$obj->category_id = $request->category_id;
			$obj->color_id = $request->color_id;
			$obj->brand_id = $request->brand_id;
			$obj->ideal_id = $request->ideal_id;
			$obj->description = $request->description;
			$obj->access_url = $request->access_url;
			$obj->UPC = $request->UPC;
			$obj->stock = $request->stock;
			$obj->price = $request->price;
			$obj->image = $pic;

			$obj->save();
			
			if($request->hasfile('images'))
			{
				foreach($request->file('images') as $id=>$i)
				{
					$name = $i->getClientOriginalName();
					$pic = $i->storeAs('public/images/products/'.$request->UPC.'',''.$request->UPC.'-'.++$id.".jpg");
					$data[] = $name;

					$id = Product::where('UPC',$request->UPC)->first('id');

					products_image::insert(['product_id'=>$id['id'],'image'=>$pic]);
				}
			}
		}
		return back()->with("message","Product added successfully");
	}

	public function checkproduct(Request $request)
	{  
		if($request->ajax())
		{
			$id = $request->id;

			$name = $request->name;

			$temp = 0;

			$temp = Product::where('name', $name)->get()->count();

			$self_count = Product::where('name',$name)->where('id',$id)->get()->count();

			if($temp == $self_count)
			{
				return "true";
			}
			else
			{
				return "false";
			}
		}
	}

	public function checkupc(Request $request)
	{  
		if($request->ajax())
		{
			$upc_count = Product::where('UPC', $request->UPC)->get()->count();

			if($upc_count <= 0)
			{
				return "true";
			}
			else
			{
				return "false";
			}
		}
	}

	public function show()
	{
		$products = Product::join('colors', 'products.color_id', '=', 'colors.id')
		->join('categories', 'products.category_id', '=', 'categories.id')
		->join('brands', 'products.brand_id', '=', 'brands.id')
		->join('ideals', 'products.ideal_id', '=', 'ideals.id')
		->select('products.*', 'products.id as product_id','products.stock as product_stock','products.status as product_status','products.name as product_name','products.price as product_price', 'categories.*','categories.id as category_id','categories.name as category_name','colors.*','colors.id as 	color_id','colors.name as color_name','brands.*','brands.id as brand_id','brands.name as brand_name','ideals.*','ideals.id as ideal_id','ideals.name as ideal_name')
		->where('products.status','!=','t')
		->get();

		return view('layout.admin.product.showproducts',['products'=>$products]);
	}

	public function status(Request $request)
	{
		Product::where('id',$request->id)->update(['status'=>$request->status]);
	}

	public function delete(Request $request,$id)
	{
		Product::where('id',$request->id)->update(['status'=>"t"]);	

		return back()->with("message","Product Deleted Successfully");
	}

	public function trash()
	{
		$trashproducts = Product::join('colors', 'products.color_id', '=', 'colors.id')
		->join('categories', 'products.category_id', '=', 'categories.id')
		->join('brands', 'products.brand_id', '=', 'brands.id')
		->select('products.*', 'products.id as product_id','products.stock as product_stock','products.status as product_status','products.name as product_name','products.price as product_price', 'categories.*','categories.id as category_id','categories.name as category_name','colors.*','colors.id as 	color_id','colors.name as color_name','brands.*','brands.id as brand_id','brands.name as brand_name')
		->where('products.status','=','t')
		->get();

		return view('layout.admin.product.trashproduct',['trashproducts'=>$trashproducts]);	
	}

	public function restore($id)
	{
		Product::where('id',$id)->update(["status"=>"y"]);

		return back()->with("message","Product restored successfully");
	}

	public function edit($id)
	{
		$product_name = Product::where('id',$id)->get();


		$category_id = Product::select('category_id')->where('id',$id)->get()->first();

		$category_name = Category::where('id',$category_id->category_id)->get();

		$color_id = Product::select('color_id')->where('id',$id)->get()->first();

		$color_name = Color::where('id',$color_id->color_id)->get();

		$brand_id = Product::select('brand_id')->where('id',$id)->get()->first();

		$brand_name = Brand::where('id',$brand_id->brand_id)->get();

		$ideal_id = Product::select('ideal_id')->where('id',$id)->get()->first();

		$ideal_name = ideal::where('id',$ideal_id->ideal_id)->get();

		$data = products_image::where('product_id',$id)->get();

		return view('layout.admin.product.editproduct',['products'=>$product_name, 'categories'=>$category_name,'colors' =>$color_name, 'images'=>$data,'brands'=>$brand_name,'ideals'=>$ideal_name]);

	}

	public function checkeditname(Request $request)
	{
		if($request->ajax())
		{
			$name = $request->name;
			$id = $request->id;

			$count = Product::where('name',$name)->get()->count();

			$self_count = Product::where('name',$name)->where('id',$id)->get()->count();

			if($count == $self_count)
			{
				return "true";
			}

			else
			{
				return "false";
			}
		}

	}
	
	public function update(Request $request)
	{
		$name = $request->name;
		$id = $request->id;

		$validator = Validator::make($request->all(), 
			[ 
				'name' => 'required|unique:products,name,' .$id
			]);

		if($validator->fails())
		{
			return back()->withErrors($validator);
		}

		else
		{
			Product::where('id',$id)->update(['name'=>$name,'price'=>$request->price,'stock'=>$request->stock,'description'=>$request->description]);   
		}

		$image_count = products_image::select('image')->where('product_id',$request->id)->get()->count();

		for($t = 0; $t < $image_count; $t++)
		{
			if(isset($request->deleteimage[$t]))
			{
				$image_name = products_image::select('image')->where('id','=', $request->deleteimage[$t])->first();

				$img_name = $image_name['image'];

				File::delete('storage/app/'.$img_name);

				products_image::where('id',$request->deleteimage[$t])->delete();	
			}
		}	

		if(file_exists($request->image))
		{
			$pic = request()->file('image')->storeAs('public/images/products/' .$request->upc.'',"main.jpg");

			Product::where('id',$request->id)->update(['image'=>$pic]);
		}


		if($request->hasfile('photos'))
		{
			$count = products_image::where('product_id',$id)->get()->count();

			foreach($request->file('photos') as $i)
			{
				$name = $i->getClientOriginalName();
				$pic = $i->storeAs('public/images/products/'.$request->upc.'',''.$request->upc.'-'.$count++.".jpg");
				$data[] = $name;

				products_imageImage::insert(['product_id'=>$id,'image'=>$pic]);
			}
		}
		return back()->with("message","Product Updated Successfully");
	}
}



















