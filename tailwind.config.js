
module.exports = {
  purge: [],
  theme: {
      extend: {
          backgroundImage: theme =>({
              'admin_bg': "url('{{asset('images/admin-bg.jpg')}}')",
          }),
          colors: {
              secondary: "#86A6DF",
              primary: "#F5F5F5",
              background: "#212B33",
              semi: 'rgba(0, 0, 0, 0.75)',
              trans_gray:'rgba(255,255,255,0.5)',
              womanbg:'#C58A8A',
              hard_red:'#ea5455',
              hard_orange:'#f07b3f',
              hard_blue:'#2d4059',
              hard_green:{
                  1:'#236969',
                  2:'#427a5b',
                  3:'#62929a'},
              dark_gray:'#403f3f',
              hard_purple:{
                  1:'#433466',
                  2:'#876a96',
              },
              dribbble:'#82D2EE',
              alert:'#FFAE33',
              logout:'#182238',
              soft_pink:'#F1EEF9',
              soft_purple:'#cabbe9',
              soft_skin:'#e2ded3',
              soft_bluee:'#4b89ac',
              redme:'#28385e',
              cello: {
                  50: '#F4F5F7',
                  100: '#EAEBEF',
                  200: '#C9CDD7',
                  300: '#A9AFBF',
                  400: '#69748E',
                  500: '#28385E',
                  600: '#243255',
                  700: '#182238',
                  800: '#12192A',
                  900: '#0C111C',
              },
              whitie:'#fdfdfd',
              soft_blue:'#a1eafb',
              blackie:'#3f3b3b',
          },
          inset:{
              '1/2': '50%',
          }   ,
          fontFamily: {
              poppins: ['Poppins'],
              handwrite:['Gochi Hand'],
              dancing:['Dancing Script'],
          },
          borderRadius:{
              'xl':'1em',
              'custom':'2rem',
              'custom_bg':'3em',
          },
          zIndex:{
              '120':120,
            '100':100,
              '80':80,
              '70':70,
          },
          height:{
            '1/2':'50%',
              '5/7':'71.4285%',
              '12/10':'120%',
              '1/3':'35%',
              '8/10':'85%',
              '2/10':'15%',
          },
          width:{
            '12/10':'120%',
          },
          translate: {
                      '1/7': '14.2857143%',
           '2/7': '28.5714286%',
           '3/7': '42.8571429%',
            '4/7': '57.1428571%',
              '5/7': '71.4285714%',
            '6/7': '85.7142857%',
                },
          fontSize: {
              // Or with a default line-height as well
             '7xl':'6rem',
          }
       },

  },
  variants: {},
  plugins: [],
}
