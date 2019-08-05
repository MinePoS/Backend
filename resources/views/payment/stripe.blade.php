  <div class="form-row">
    <label for="card-element" style="color:white;">
      Credit or debit card
    </label>
    <div id="card-element">
      <!-- A Stripe Element will be inserted here. -->
    </div>

<style type="text/css">
  .form-control{
    padding: 10px 12px;
border: 1px solid transparent;
border-radius: 4px;
background-color: #252830;
box-shadow: 0 1px 3px 0 #e6ebf1;
color: white;
  }


</style>
    <!-- Used to display form errors. -->
    <div id="card-errors" role="alert"></div>
    </div>
    <div class="form-row">
   
    <div class="col">
      <label for="name">
        Name
      </label>
      <input id="name" class="form-control" name="name" placeholder="John Doe" required>
    </div>
    <div class="col">
        <label for="email">
          Email Address
        </label>
        <input id="email" class="form-control" name="email" type="email" placeholder="johny-boy@minepos.net" required>
      </div>
      
  </div>


<script type="text/javascript">
function stripeSetup(){
	// Create a Stripe client.

var stripe = Stripe('{{setting('STRIPE_PUBLIC')}}');
document.stripe = stripe;
var elements = stripe.elements();

var style = {
  base: {
    color: '#ffffff',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
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

// Create an instance of the card Element.
var card = elements.create('card', {style: style});

card.mount('#card-element');

card.addEventListener('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

// Handle form submission.
var form = document.getElementById('payment-form');
// form.addEventListener('submit', function(event) {
//   event.preventDefault();

//   stripe.createToken(card).then(function(result) {
//     if (result.error) {
//       // Inform the user if there was an error.
//       var errorElement = document.getElementById('card-errors');
//       errorElement.textContent = result.error.message;
//     } else {
//       // Send the token to your server.
//       stripeTokenHandler(result.token);
//     }
//   });
// });
var cardholderName = document.getElementById('name');
var cardButton = document.getElementById('card-button');
var clientSecret = cardButton.dataset.secret;

cardButton.addEventListener('click', function(ev) {

  stripe.handleCardPayment(
    clientSecret, card, {
      payment_method_data: {
        billing_details: {name: cardholderName.value}
      }
    }
  ).then(function(result) {
    if (result.error) {
      alert(result.error.message)
    } else {

      var form = document.getElementById('payment-form');
      document.res = result;
      var hiddenInput = document.createElement('input');
      hiddenInput.setAttribute('type', 'hidden');
      hiddenInput.setAttribute('name', 'PAYMENT_INTENT_ID');
      hiddenInput.setAttribute('value', result.paymentIntent.id);
  form.appendChild(hiddenInput);

     form.submit();
     // alert("it worked");
    }
  });
});

}

// Submit the form with the token ID.
function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', '_token');
  hiddenInput.setAttribute('value', '{{ csrf_token() }}');
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
}
</script>