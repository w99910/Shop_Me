<div class="h-full w-full px-5 py-3 bg-soft_pink flex rounded-custom">
    <div class="absolute top-0 left-0 mt-4 ml-4">
        <a href="{{route('home')}}" class="focus:outline-none">
            <svg id="color" enable-background="new 0 0 24 24" height="32" viewBox="0 0 24 24" width="32" xmlns="http://www.w3.org/2000/svg"><path d="m12 0c-6.617 0-12 5.383-12 12s5.383 12 12 12 12-5.383 12-12-5.383-12-12-12z" fill="#2196f3"/><path d="m12 0c-6.617 0-12 5.383-12 12s5.383 12 12 12z" fill="#1d83d4"/><path d="m10.73 18.791-6.5-6.25c-.147-.142-.23-.337-.23-.541s.083-.399.23-.541l6.5-6.25c.475-.458 1.27-.119 1.27.541v3.25h5.75c.689 0 1.25.561 1.25 1.25v3.5c0 .689-.561 1.25-1.25 1.25h-5.75v3.25c0 .664-.798.995-1.27.541z" fill="#fff"/><path d="m19 12h-15c0 .204.083.399.23.541l6.5 6.25c.15.145.334.21.514.21.385-.001.756-.299.756-.751v-3.25h5.75c.689 0 1.25-.561 1.25-1.25z" fill="#dedede"/></svg>
        </a>

    </div>
     <div class="w-full sm:p-5 flex flex-col sm:flex-row">
         <div class="w-full sm:w-1/2 sm:p-1 h-full bg-background rounded-xl sm:mr-5">
             <div class="flex flex-col w-full px-4 justify-around py-3 bg-hard_green text-white rounded-xl h-full">
               <table class="table-fixed h-1/2 w-full">
                     <tbody>
                     <tr class="py-2">
                         <td>Name:</td><td>{{$user->name}}</td><td><button class="px-2 py-2 rounded-lg bg-logout" id="name">Change Name</button></td>
                     </tr>
                     <tr class="py-2">
                         <td>Email:</td><td>{{$user->email}}</td><td><button class="px-2 py-2 rounded-lg bg-logout" id="email">Change Email</button></td>
                     </tr>
                     <tr class="py-2">
                         <td>Password:</td><td> ------- </td><td><button class="px-2 py-1 rounded-lg bg-logout" id="password">Change Password</button></td>
                     </tr>
                     </tbody>

                 </table>
                 <div class="flex w-full justify-between my-10 sm:my-0">
                     <img src="{{ $user->profile_url === null ? Avatar::create(auth()->user()->name)->toBase64() : $user->profile_url  }}" alt="{{$user->name}}" class="w-16 h-16 rounded-full">
                  <div class="flex justify-center items-center flex-col sm:flex-row sm:ml-0 ml-5">
                      <button class="px-2 py-2 rounded-lg bg-logout sm:mb-0 mb-4 " id="image">Change Profile Image</button>
                     <button class="px-2 py-2 rounded-lg bg-logout sm:ml-3" wire:click="delete">Delete Profile Image</button>
                  </div>
                 </div>
             </div>

         </div>
         <div class="w-full sm:w-1/2 h-full flex flex-col p-1 sm:mt-0 mt-3">
             <div class="w-full sm:h-1/2 bg-background rounded-xl p-1 mb-3">
           <div class="w-full h-full bg-hard_red rounded-xl px-2 py-2 text-white">
               <table class="table-auto overflow-auto">
                   <tr><span class="text-xl font-bold">Your Favourite</span></tr>

                   @if (!empty(auth()->user()->favourites))

                       @foreach(auth()->user()->favourites as $favourite)
                           <tr class="flex flex-wrap items-center justify-between">
                               <td class="w-2/12"> <img src="{{url($favourite->product->image_path)}}" class="object-center object-cover"/> </td>
                               <td class="truncate">{{$favourite->product->name}}</td>
                               <td><button class="px-2 py-1 bg-red-600 focus:outline-none"  wire:click="deleteFav({{$favourite->id}})"><i class="fas fa-times"></i></button></td> </tr>
                       @endforeach

                   @endif
                   @if (auth()->user()->favourites->count()==0)
                       <tr><td>You still don't have favourites</td></tr>
                   @endif
               </table>
           </div>
             </div>
           <div class="w-full sm:h-1/2 h-full bg-background rounded-xl p-1">
               <div class="w-full h-full bg-hard_orange rounded-xl p-2">
               <table class="table-fixed text-redme w-full h-full">
                   <thead>
                  <tr><span class="text-xl font-bold text-redme">Your Invoice History</span></tr>
                   <tr>
                       <th class="px-4 py-2">Amount Used</th>
                       <th class="px-4 py-2">Date</th>
                       <th class="px-4 py-2">Ago</th>
                   </tr>
                   </thead>
                   <tbody>
                   @foreach($invoices as $invoice)
                       <tr>
                           <td class="border border-redme px-4 py2">{{$invoice->invoice}}$</td>
                           <td class="border border-redme px-4 py2">{{$invoice->created_at}}</td>
                           <td class="border border-redme px-4 py2">{{$invoice->time}}</td>
                       </tr>
                   @endforeach
                   </tbody>
               </table>
               </div>
           </div>
         </div>
     </div>
</div>
@push('scripts')
  <script>
      document.getElementById('name').addEventListener('click', async()=>  {
          const {value:name}=await Swal.fire({
               title:'Change Name',
             html:'<input id="swal-input1" class="swal2-input" type="text" placeholder="New Name" autocomplete="off" required>'
                      ,
              focusConfirm: true,
              preConfirm: () => {
                  return [
                      document.getElementById('swal-input1').value,
                  ]
              } ,
              showCancelButton: true,
          });
           if(name){
              window.livewire.emit('changeName',name[0]); }
      });
      document.getElementById('email').addEventListener('click', async()=>  {
          const {value:email}=await Swal.fire({
              title:'Change Name',
              html:'<input id="swal-input1" class="swal2-input" type="text" placeholder="New Email" autocomplete="off" required>'
              ,
              focusConfirm: true,
              preConfirm: () => {
                  return [
                      document.getElementById('swal-input1').value,
                  ]
              } ,
              showCancelButton: true,
          });
          if(email){
              window.livewire.emit('changeEmail',email[0]); }
      });
      document.getElementById('password').addEventListener('click', async()=>  {
          const {value:password}=await Swal.fire({
              title:'Change Name',
              html:'<input id="swal-input1" class="swal2-input" type="password" placeholder="Old Password" autocomplete="off" required>'+
                  '<input id="swal-input2" class="swal2-input" type="password" placeholder="New Password" autocomplete="off" required>'+
                  '<input id="swal-input3" class="swal2-input" type="password" placeholder="Confirm Password" autocomplete="off" required>' +
                  '<p class="text-xs text-alert"> New Password Length must be minimum 6 </p>'
              ,
              focusConfirm: true,
              preConfirm: () => {
                  return [
                      document.getElementById('swal-input1').value,
                      document.getElementById('swal-input2').value,
                      document.getElementById('swal-input3').value,
                  ]
              } ,
              showCancelButton: true,
          });
          if(password){
              if(password[1] === password[2] && password[1].length>6){
                  window.livewire.emit('changePassword',password);
              }
              else {
                  Swal.fire({
                      icon:'error',
                      text:'Please Try again'
                  })
              }

              // window.livewire.emit('changePassword',password[2]).then((res => {
              //    console.log(res);
              // }));
          }
      });
      window.livewire.on('message_change',data=>{
          Swal.fire({
              icon:data[0],
              text:data[1],
          })
      })
      document.getElementById('image').addEventListener('click', async()=>  {
          const {value:image}=await Swal.fire({
              title:'Change Name',
              html:'<input id="swal-input1" class="swal2-file" type="file" placeholder="Image" autocomplete="off" required>'
              ,
              focusConfirm: true,
              preConfirm: () => {
                  return [
                      document.getElementById('swal-input1').value,
                  ]
              } ,
              showCancelButton: true,
          });
         if(image) {
             let inputfile = document.getElementById('swal-input1');
             let file=inputfile.files[0];
             var t = file.type.split('/').pop().toLowerCase();
             if (t != 'jpg' && t != 'png' && t != 'jpeg') {
                 Swal.fire({
                     icon: "error",
                     text: "Only Image is allowed",
                 })
             } else {
                 let reader = new FileReader();
                 reader.onload = () => {
                     var info = reader.result;
                     window.livewire.emit('changeImage',info);
                 }

                 reader.readAsDataURL(file);
             }
         }
         });

  </script>
    @endpush

