package com.asfwan.mygps;

import android.content.Context;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.Bundle;

/**
 * Created by asfwan on 11/10/14.
 */
public class ASFGPSManager implements LocationListener {

    Context context;
    LocationManager lManager;
    OnGpsChangedCallback gpsChangedCallback = null;

    ASFGPSManager(Context context){
            this.context = context;
            lManager = (LocationManager)
                    context.getSystemService(Context.LOCATION_SERVICE);
    }

    public void requestLocationUpdates(OnGpsChangedCallback onGpsChangedCallback){
        lManager.requestLocationUpdates(LocationManager.GPS_PROVIDER,1000,10,this);
        this.gpsChangedCallback = onGpsChangedCallback;
    }

    public void recycle(){
        lManager.removeUpdates(this);
    }

    @Override
    public void onLocationChanged(Location location) {
        /* * *
        * Put some codes to be executed when the location is obtained
        */

        //examples
        double lat = location.getLatitude();
        double lng = location.getLongitude();

        if(this.gpsChangedCallback!=null){
            gpsChangedCallback.onGpsLocationObtained(lat,lng);
        }
    }

    @Override
    public void onStatusChanged(String s, int i, Bundle bundle) {
        /* * *
        * No need for any code here
        */
    }

    @Override
    public void onProviderEnabled(String s) {
        /* * *
        * No need for any code here
        */
    }

    @Override
    public void onProviderDisabled(String s) {
        /* * *
        * No need for any code here
        */
    }
}
