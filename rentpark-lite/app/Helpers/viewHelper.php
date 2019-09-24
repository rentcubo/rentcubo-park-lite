<?php

use App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\File;

/**
 * @method upload_picture()
 * 
 * @uses used to upload the picture
 *
 * @created BALAJI M
 *
 * @updated VITHYA
 *
 * @param image, destination
 *
 * @return image url
 *
 */
function upload_picture($image, $destination) {

    $extension = $image->getClientOriginalExtension();

    $filename = rand().".".$extension;

    $image->move(public_path().$destination, $filename);

    return url($destination, $filename);     

}

/**
 * @method delete_picture()
 * 
 * @uses To delete the image
 *
 * @created BALAJI M
 *
 * @updated VITHYA
 *
 * @param image and destination
 *
 * @return Null
 *
 */

function delete_picture($image, $destination) {

    $image_name = basename($image);

    $image_path = public_path($destination.'/'.$image_name);
   
    if(File::exists($image_path)) {
            
        File::delete($image_path);
    }

    return null;
}

/**
 * @method formatted_amount()
 *
 * @uses used to format the number
 *
 * @created vidhya R
 *
 * @updated vidhya R
 *
 * @param integer $num
 * 
 * @param string $currency
 *
 * @return string $formatted_amount
 */

function formatted_amount($amount = 0.00, $currency = "") {

    $currency = $currency ?: Setting::get('currency', '$');

    $amount = number_format((float)$amount, 2, '.', '');

    $formatted_amount = $currency."".$amount ?: "0.00";

    return $formatted_amount;
}

/**
 * @method common_date()
 *
 * @uses to formate date with TimeZone
 *
 * @created Vidhya R
 *
 * @updated Anjana H
 *
 * @param integer $num
 * 
 * @param string $currency
 *
 * @return string $formatted_amount
 */
function common_date($date , $timezone = "" , $format = "d M Y h:i A") {

    if($date == "0000-00-00 00:00:00" || $date == "0000-00-00" || !$date) {

        return $date;
    }

    if($timezone) {

        $date = convertTimeToUSERzone($date , $timezone , $format);

    }

    return date($format , strtotime($date));

}

/**
 * Function Name: tr()
 *
 * Description: used to convert the string to language based string
 *
 * @created Vidhya R
 *
 * @updated
 *
 * @param string $key
 *
 * @return string value
 */
function tr($key , $additional_key = "" , $lang_path = "messages.") {

    if (!\Session::has('locale')) {

        $locale = \Session::put('locale', config('app.locale'));

    }else {

        $locale = \Session::get('locale');

    }
        
    return \Lang::choice('messages.'.$key, 0, Array('other_key' => $additional_key), $locale);
}


/**
 * @method booking_status()
 * 
 * @uses To display the booking value
 *
 * @created Naveen
 *
 * @updated 
 *
 * @param image and destination
 *
 * @return 
 *
 */

function booking_status($status) {

    switch($status){
    
        case(BOOKING_NONE):
          return "<td><div class='text-primary'>".tr('none')."</div></td>";
        break;

        case(BOOKING_CREATED);
          return "<td><div class='text-info'>".tr('booking_created')."</div></td>";
        break;

        case(BOOKING_CHECKIN):
           return "<td><div class='text-primary'>". tr('checkin') ."</div></td>";
        break;

        case(BOOKING_CHECKOUT):
          return "<td><div class='text-primary'>". tr('checkout') ."</div></td>";
        break;

        case(BOOKING_COMPLETED):
          return "<td><div class='text-success'>". tr('completed') ."</div></td>";
        break;

        case(BOOKING_USER_CANCEL):
          return "<td><div class='text-danger'>". tr('user_cancel') ."</div></td>";
        break;

        case(BOOKING_PROVIDER_CANCEL):
          return "<td><div class='text-danger'>". tr('provider_cancel') ."</div></td>";
        break;

    }
}

/**
 * @method time_show()
 *
 * @uses To show the hour
 *
 * @created Naveen
 *
 * @updated 
 *
 * @param integer hour
 *
 * @return string hour
 */

function time_show($hour = 0.00) {

    if($hour <= 1) {

        return $hour." hour";

    } else {

        return round($hour,2)." hours";
    }

}