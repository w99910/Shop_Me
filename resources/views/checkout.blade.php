@extends('layouts.home_layout')
@section('content')
    <div class="h-screen bg-soft_pink rounded-custom w-full p-1">
        <div class="w-full h-full inline-block sm:block">
            <div class="w-full py-5 rounded-none shadow-xl sm:px-5 px-1 h-full flex flex-col sm:flex-row md:flex-row lg:flex-row bg-transparent sm:rounded-custom">
                <div class="h-full w-full sm:w-1/3 ">
                   <div class="h-full w-full p-1 bg-redme rounded-lg" x-data="my_data()" x-init="init">
                    <form id="checkout-form" class="h-full rounded-lg bg-white flex flex-col justify-between" >
                        @csrf

                        <div class="flex flex-col">
                            <div class="flex flex-col">
                                <input id="first-name" name="first_name" x-model="first_name"  placeholder="First name" type="text" class="focus:outline-none border focus:border-blue-300 px-2 py-1 my-3 mx-3 rounded shadow" autocomplete="off">
                            </div>
                            <div class="flex flex-col">
                                <input id="last-name" x-model="last_name" name="last_name" placeholder="Last name" type="text" class="focus:outline-none border focus:border-blue-300 px-2 py-1 my-3 mx-3 rounded shadow" autocomplete="off">
                            </div>
                            <div class="flex flex-col">
                                <input id="email" x-model="email" name="email" placeholder="Email" type="text" class="focus:outline-none border focus:border-blue-300 px-2 py-1 my-3 mx-3 rounded shadow" autocomplete="off">
                            </div>
                            <div class="flex flex-col">
                                <input id="ph_no" name="ph_no" x-model="ph_no" placeholder="Phone Number" type="text" class="focus:outline-none border focus:border-blue-300 px-2 py-1 my-3 mx-3 rounded shadow" autocomplete="off">
                            </div>

                        </div>
                        <input id="payment_method" type="hidden" name="payment_method" value="">
                        <!-- Stripe Elements Placeholder -->
                        <div id="card-element" class="focus:outline-none border focus:border-blue-300 px-2 py-1 my-3 mx-3 rounded shadow" ></div>
                        <div class="px-3">
                            <ul>
                                <li class="flex justify-start items-center">
                                    <i class="far fa-check-circle text-green-700" x-show="first_name.trim()!==''"></i>
                                    <i class="fas fa-exclamation-circle text-red-700" x-show="first_name.trim()===''"></i>
                                    <span :class="{'text-green-700':  first_name.length > 0, 'text-red-700': first_name.length == 0}"
                                          class="font-medium text-sm ml-3"
                                          x-text="first_name.length > 0 ? 'First Name' : 'First Name is required' ">
                                    </span>
                                </li>
                                <li class="flex justify-start items-center">
                                    <i class="far fa-check-circle text-green-700" x-show="last_name.trim()!==''"></i>
                                    <i class="fas fa-exclamation-circle text-red-700" x-show="last_name.trim()===''"></i>
                                    <span :class="{'text-green-700':  last_name.length > 0, 'text-red-700': last_name.length == 0}"
                                          class="font-medium text-sm ml-3"
                                          x-text="last_name.length > 0 ? 'Last Name' : 'Last Name is required' ">
                                    </span>
                                </li>
                                <li class="flex justify-start items-center">
                                    <i class="far fa-check-circle text-green-700" x-show="isEmail "></i>
                                    <i class="fas fa-exclamation-circle text-red-700" x-show="!isEmail"></i>
                                    <span :class="isEmail ? 'text-green-700':'text-red-700'"
                                          class="font-medium text-sm ml-3"
                                          x-text=" isEmail ? 'Email' : 'Email must be valid' " >
                                    </span>
                                </li>
                                <li class="flex justify-start items-center">
                                    <i class="far fa-check-circle text-green-700" x-show="ph_no.trim()!==''"></i>
                                    <i class="fas fa-exclamation-circle text-red-700" x-show="ph_no.trim()===''"></i>
                                    <span :class="{'text-green-700':  ph_no.length > 0, 'text-red-700': ph_no.length == 0}"
                                          class="font-medium text-sm ml-3"
                                          x-text="ph_no.length > 0 ? 'Phone Number' : 'Phone Number is required' ">
                                    </span>
                                </li>

                            </ul>

                        </div>

                        <button id="card-button" class="px-3 py-2 text-white flex items-center justify-center" :class="first_name.trim() === ''||last_name.trim()===''||email.trim()===''||ph_no.trim()===''?'bg-red-500':'bg-green-500'"  x-bind:disabled="first_name.trim() === '' ||last_name.trim()===''||email.trim()===''">
                            <i class="fas fa-circle-notch fa-spin fa-2x text-blue-600 hide" id="spinner"></i>   Pay
                        </button>

                    </form>

                   </div>
                </div>
                @livewire('checkout')
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
    const my_data=function(){

        return {
            first_name:'',
            last_name:'',
            email:'',
            ph_no:'',
            disable_button:true,
            check(){
                if (this.first_name.trim() === '' && this.last_name.trim() === '' && this.email.trim() === '' && this.ph_no.trim() === '') {
                    this.disable_button = true;
                    console.log(this.first_name)
                } else {
                    this.disable_button = false;
                }
            },
            init(){
              this.$watch('email',(val)=> this.validate_mail(val))

            },
            isEmail:false,

            validate_mail(val){
                if(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(val))
                {
                    this.isEmail=true;
                }
                else
                    this.isEmail=false;
            }
        }

    }
    function ValidateEmail(mail)
    {
        if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(mail))
        {
            return true;
        }

        return false;
    }
    function stripeTokenHandler(token){
        var form=document.getElementById('checkout-form');
        var hiddenInput=document.createElement('input');
        hiddenInput.setAttribute('type','hidden');
        hiddenInput.setAttribute('name','stripeToken');
        hiddenInput.setAttribute('value',token);
        form.appendChild(hiddenInput);

    }
    let firstname=document.getElementById('first-name');
    let lastname=document.getElementById('last-name');
    let email=document.getElementById('email');
    let ph_no=document.getElementById('ph_no');
    $(document).ready(function() {
        let stripe = Stripe("{{env('STRIPE_KEY')}}");

        let elements = stripe.elements();
        let style = {
            base: {
                lineHeight: '18px',
                fontFamily:'Poppins',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };
        let card = elements.create('card',{style:style});
        let name = document.getElementById('first-name')+" "+ document.getElementById('last-name');
        card.mount('#card-element');
        let paymentMethod = null
        $('#checkout-form').on('submit', function (e) {
            if (paymentMethod) {
                return true;
            }
           if ({{auth()->user()->carts->isEmpty()}})
            {
                Swal.fire({
                    icon:'warning',
                    text:'There is no product in your cart'
                })

            }
             else if (firstname.value.trim()===''&&lastname.value.trim()===''&&email.value.trim()===''&&ph_no.value.trim()==='')
        {
            Swal.fire({
                icon:"error",
                text:"Input fields are required. Please Try again"
            })

        }  else if(!ValidateEmail(email.value)) {
            Swal.fire({
                icon:'error',
                text:'You must enter valid email'
            })
        }
        else{
            stripe.confirmCardSetup(
                "{{$intent->client_secret}}",
                {
                    payment_method: {
                        card: card,
                        billing_details: {name: name}

                    }
                }
            ).then(function (result) {
                if (result.error) {
                    // console.log(result);
                } else {
                    // console.log(result.setupIntent.id);
                    paymentMethod = result.setupIntent.payment_method;
                    stripeTokenHandler(result.setupIntent.id);
                    $('#payment_method').val(paymentMethod)
                    const data=$("#checkout-form").serialize();
                       var spinner=document.getElementById('spinner');
                       spinner.classList.remove('hide');
                    function sleep(ms) {
                        return new Promise(resolve => setTimeout(resolve, ms));
                    }

                    async function delayedGreeting() {
                        await sleep(3500);
                        location.reload();
                    }
                    axios.post('{{route('checkout.process')}}',data).then((res)=>{
                                spinner.classList.add('hide');

                               Swal.fire({
                                   icon:'success',
                                   text:'Success checkout.Please check your email for more information.',
                                   toast:true,
                                   position:'top-end',
                                   timer:3000,
                                   showConfirmButton:false,
                                   showCloseButton:false,
                               })
                    }).then(()=>{
                       delayedGreeting();

                    })
                    // $('#checkout-form').submit()
                }
            });
        }
            return false;
        });
    });
</script>
@endpush
 @push('styles')
     <style>
         .hide{
             display: none !important;
         }
     </style>
     @endpush
