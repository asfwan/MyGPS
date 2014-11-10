package com.asfwan.mygps;

import android.app.Activity;
import android.os.Bundle;
import android.widget.TextView;


public class MyActivity extends Activity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_my);

        final TextView tv = (TextView) findViewById(R.id.text);

        final ASFGPSManager gpsManager = new ASFGPSManager(this);
        gpsManager.requestLocationUpdates(new OnGpsChangedCallback(){
            @Override
            public void onGpsLocationObtained(double lat,double lng) {
                tv.setText("Latitude: "+lat+" Longitude: "+lng);
                gpsManager.recycle();
            }
        });
    }

}
