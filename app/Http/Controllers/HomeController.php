<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;

use App\Models\Product;

use App\Models\Cart;

use App\Models\Order;

use Session;

use Stripe;

use App\Models\Comment;

use App\Models\Reply;

use App\Models\Contact;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::id()) {
            $usertype = Auth::user()->usertype;

            if ($usertype == '1') {
                $total_product = product::all()->count();

                $total_order = order::all()->count();

                $total_user = user::all()->count();

                $order = order::all();

                $total_revenue = 0;

                foreach ($order as $order) {
                    $total_revenue = $total_revenue + $order->price;
                }


                $total_delivered = order::where('delivery_status', '=', 'delivered')->get()->count();


                $total_processing = order::where('delivery_status', '=', 'processing')->get()->count();



                return view('admin.home', compact('total_product', 'total_order', 'total_user', 'total_revenue', 'total_delivered', 'total_processing'));
            } elseif ($usertype == '0') {
                $product = Product::orderby('id', 'desc')->paginate(9);

                $comment = comment::orderby('id', 'desc')->get();



                $reply = reply::all();

                $user_id = Auth::user()->id;

                $cart_count = count((array)(session('cart')));

                return view('home.userpage', compact('product', 'comment', 'reply', 'cart_count'));
            }
        } else {
            $product = Product::orderby('id', 'desc')->paginate(9);


            $comment = comment::orderby('id', 'desc')->get();

            $reply = reply::all();
            $cart_count = count((array)(session('cart')));



            return view('home.userpage', compact('product', 'comment', 'reply', 'cart_count'));
        }
    }


    public function redirect()
    {
        $usertype = Auth::user()->usertype;

        if ($usertype == '1') {
            $total_product = product::all()->count();

            $total_order = order::all()->count();

            $total_user = user::all()->count();

            $order = order::all();

            $total_revenue = 0;

            foreach ($order as $order) {
                $total_revenue = $total_revenue + $order->price;
            }


            $total_delivered = order::where('delivery_status', '=', 'delivered')->get()->count();


            $total_processing = order::where('delivery_status', '=', 'processing')->get()->count();



            return view('admin.home', compact('total_product', 'total_order', 'total_user', 'total_revenue', 'total_delivered', 'total_processing'));
        } else {
            $product = Product::orderby('id', 'desc')->paginate(9);

            $comment = comment::orderby('id', 'desc')->get();



            $reply = reply::all();

            $user_id = Auth::user()->id;

            $cart_count = count((array)(session('cart')));



            return view('home.userpage', compact('product', 'comment', 'reply', 'cart_count'));
        }
    }


    public function product_details($id)
    {
        if (Auth::id()) {
            $product = product::find($id);

            $user_id = Auth::user()->id;

            $cart_count = count((array)(session('cart')));

            return view('home.product_details', compact('product', 'cart_count'));
        } else {
            $product = product::find($id);
            $cart_count = count((array)(session('cart')));

            return view('home.product_details', compact('product', 'cart_count'));
        }
    }

    public function add_cart(Request $request, $id)
    {
        $product = product::find($id);
        $cart = session('cart');
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $cart[$id]['quantity'] + $request->quantity;
        } else {
            $cart[$id] = [
                'product_title' => $product->title,
                'price' => $product->discount_price != null ? $product->discount_price * $request->quantity : $product->price * $request->quantity,
                'quantity' => $request->quantity,
                'image' => $product->image
            ];
        }
        session()->put('cart', $cart);
        Alert::success('Product Added to Cart', 'Congrats!!! You\'ve Successfully Added Product to the cart');

        return redirect()->back();
    }


    public function show_cart()
    {
        $cart_count = count((array)(session('cart')));
        $cart = session('cart');
        if (!$cart) {
            $cart = null;
        }
        $user = new User();
        if (Auth::id()) {
            $user->id = Auth::user()->id;
            $authUser = User::find($user->id);

            $user->name = $authUser->name;
            $user->email = $authUser->email;
            $user->phone = $authUser->phone;
            $user->address = $authUser->address;
        }

        return view('home.showcart', compact('cart', 'cart_count', 'user'));
    }


    public function remove_cart($id)
    {
        $cart = session('cart');
        $tmpCart = [];
        foreach ((array)$cart as $key => $cart) {
            if ($id != $key) {
                $tmpCart[$key] = $cart;
            }
        }
        session()->put('cart', $tmpCart);
        return redirect()->back();
    }


    public function order_cash()
    {
        if (Auth::id()) {
            $user = Auth::user();

            $userid = Auth::user()->id;

            $data = session('cart');


            foreach ($data as $data) {
                $order = new testorder();

                $order->product_title = $data['product_title'];


                $order->save();
            }

            return redirect()->back();
        } else {
            return redirect('login');
        }
    }


    public function cash_order(Request $request, $totalproduct)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->usertype = 0;

        if ($request->createAnAccount) {
            $password = Hash::make($request->password);
            $user->password = $password;
        } else {
            $password = Hash::make('secret');
            $user->password = $password;
        }



        if (Auth::id()) {
            $user->id = Auth::user()->id;
            $authUser = User::find($user->id);

            $user->name = $authUser->name;
            $user->email = $authUser->email;
            $user->phone = $authUser->phone;
            $user->address = $authUser->address;
        } else {
            $user->save();
        }

        if ($totalproduct == 0) {
            Alert::warning('No Product In Cart', 'Please Add some Product To the Cart');

            return redirect()->back();
        } else {
            $data = session('cart');

            foreach ((array)$data as $key => $data) {
                $order = new order();

                $order->name = $user->name;

                $order->email = $user->email;

                $order->phone = $user->phone;

                $order->address = $user->address;

                $order->user_id = $user->id;



                $order->product_title = $data['product_title'];

                $order->price = $data['price'];

                $order->quantity = $data['quantity'];

                $order->image = $data['image'];

                $order->product_id = $key;


                $order->payment_status = 'cash on delivery';

                $order->delivery_status = 'processing';

                $product=product::find($key);

                $product->quantity = $product->quantity - $data['quantity'];

                $product->save();

                $order->save();
            }
            Alert::success('Thank You For your Order', 'We have Received your Order. We will connect with you soon...');

            session()->forget('cart');

            return redirect()->back();
        }
    }


    public function stripe($totalprice)
    {
        if (Auth::id()) {
            if ($totalprice == 0) {
                Alert::warning('No Product In Cart', 'Please Add some Product To the Cart');

                return redirect()->back();
            } else {
                $userid = Auth::user()->id;

                $cart_count = count((array)(session('cart')));

                return view('home.stripe', compact('totalprice', 'cart_count'));
            }
        } else {
            return redirect('login');
        }
    }


    public function stripePost(Request $request, $totalprice)
    {
        if (Auth::id()) {
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            Stripe\Charge::create([
                "amount" => $totalprice * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Thanks for payment."
            ]);



            $user = Auth::user();

            $userid = $user->id;


            $data = cart::where('user_id', '=', $userid)->get();

            foreach ($data as $data) {
                $order = new order();

                $order->name = $data->name;

                $order->email = $data->email;

                $order->phone = $data->phone;

                $order->address = $data->address;

                $order->user_id = $data->user_id;



                $order->product_title = $data->product_title;

                $order->price = $data->price;

                $order->quantity = $data->quantity;

                $order->image = $data->image;

                $order->product_id = $data->Product_id;


                $order->payment_status = 'Paid';

                $order->delivery_status = 'processing';


                $order->save();




                $cart_id = $data->id;

                $cart = cart::find($cart_id);

                $cart->delete();
            }

            Alert::Success('Payment Successful', 'Thanks for the Order . We Will send you the Product Within 48 Hours.');

            return back();
        } else {
            return redirect('login');
        }
    }




    public function show_order()
    {
        if (Auth::id()) {
            $user = Auth::user();

            $userid = $user->id;

            $cart_count = count((array)(session('cart')));

            $order = order::where('user_id', '=', $userid)->get();

            return view('home.order', compact('order', 'cart_count'));
        } else {
            return redirect('login');
        }
    }

    public function cancel_order($id)
    {
        $order = order::find($id);

        $order->delivery_status = 'You canceled the order';


        $order->save();

        Alert::warning('Order Canceled', 'You Have Canceled Your Order');


        return redirect()->back();
    }


    public function add_comment(Request $request)
    {
        if (Auth::id()) {
            $comment = new comment();


            $comment->name = Auth::user()->name;

            $comment->user_id = Auth::user()->id;

            $comment->comment = $request->comment;


            $comment->save();

            return redirect()->back();
        } else {
            return redirect('login');
        }
    }


    public function add_reply(Request $request)
    {
        if (Auth::id()) {
            $reply = new reply();


            $reply->name = Auth::user()->name;

            $reply->user_id = Auth::user()->id;

            $reply->comment_id = $request->commentId;

            $reply->reply = $request->reply;

            $reply->save();

            return redirect()->back();
        } else {
            return redirect('login');
        }
    }


    public function product_search(Request $request)
    {
        $cart_count = count((array)(session('cart')));

        $comment = comment::orderby('id', 'desc')->get();

        $reply = reply::all();

        $serach_text = $request->search;

        $product = product::where('title', 'LIKE', "%$serach_text%")->orWhere('category', 'LIKE', "$serach_text")->orderby('id', 'desc')->paginate(9);

        return view('home.userpage', compact('product', 'comment', 'reply', 'cart_count'));
    }

    public function product()
    {
        $product = Product::paginate(9);

        $comment = comment::orderby('id', 'desc')->get();

        $reply = reply::all();

        $cart_count = count((array)(session('cart')));

        return view('home.all_product', compact('product', 'comment', 'reply', 'cart_count'));
    }


    public function search_product(Request $request)
    {
        $comment = comment::orderby('id', 'desc')->get();

        $reply = reply::all();

        $cart_count = count((array)(session('cart')));

        $serach_text = $request->search;

        $product = product::where('title', 'LIKE', "%$serach_text%")->orWhere('category', 'LIKE', "$serach_text")->paginate(9);

        return view('home.all_product', compact('product', 'comment', 'reply', 'cart_count'));
    }


    public function contact()
    {
        if (Auth::id()) {
            $user_id = Auth::user()->id;

            $cart_count = count((array)(session('cart')));

            return view('home.contact', compact('cart_count'));
        } else {
            $cart_count = count((array)(session('cart')));
            return view('home.contact', compact('cart_count'));
        }
    }


    public function add_contact(Request $request)
    {
        $contact = new contact();

        $contact->name = $request->name;

        $contact->email = $request->email;

        $contact->subject = $request->subject;

        $contact->message = $request->message;

        $contact->save();

        Alert::success('Message Received', 'We will review your message and contact with you soon');

        return redirect()->back();
    }
}