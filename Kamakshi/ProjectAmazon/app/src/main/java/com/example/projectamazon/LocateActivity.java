package com.example.projectamazon;

import android.Manifest;
import android.content.Context;
import android.content.pm.PackageManager;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.support.v4.app.ActivityCompat;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.TextView;
import android.widget.Toast;

import com.google.firebase.database.IgnoreExtraProperties;

import com.google.firebase.auth.FirebaseAuth;
import com.google.firebase.auth.FirebaseUser;
import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;

import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.Calendar;

public class LocateActivity extends AppCompatActivity implements LocationListener {

    private FirebaseAuth firebaseAuth;

    private TextView textViewUser;
    private TextView textViewlong;
    private TextView textViewlat;
    private TextView textViewdate;
    private TextView textViewtime;

    private DatabaseReference dbUsers;

    private UserLocationDetails userLocationDetails;

    private LocationManager locationManager;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_locate);


        firebaseAuth = FirebaseAuth.getInstance();


        textViewUser = (TextView)findViewById(R.id.currentuser);
        textViewlong = (TextView) findViewById(R.id.currentlongitude);
        textViewlat = (TextView)findViewById(R.id.currentlatitude);
        textViewdate =(TextView)findViewById(R.id.currentdate);
        textViewtime = (TextView)findViewById(R.id.currenttime);

        locationManager = (LocationManager) getSystemService(Context.LOCATION_SERVICE);

        if (ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED && ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_COARSE_LOCATION) != PackageManager.PERMISSION_GRANTED) {
            // TODO: Consider calling
            //    ActivityCompat#requestPermissions
            // here to request the missing permissions, and then overriding
            //   public void onRequestPermissionsResult(int requestCode, String[] permissions,
            //                                          int[] grantResults)
            // to handle the case where the user grants the permission. See the documentation
            // for ActivityCompat#requestPermissions for more details.
            return;
        }
        Location location = locationManager.getLastKnownLocation(locationManager.NETWORK_PROVIDER);

       // Toast.makeText(LocateActivity.this ,"Location" , Toast.LENGTH_SHORT).show();

        //textView.setText(location.getLatitude()+"\n"+location.getLongitude());
        onLocationChanged(location);
    }

    @Override
    public void onLocationChanged(Location location) {
        Calendar calendar = Calendar.getInstance();
        String date  = DateFormat.getDateInstance(DateFormat.FULL).format(calendar.getTime());

        SimpleDateFormat format = new SimpleDateFormat("HH:mm:ss");
        String time = format.format(calendar.getTime());

        double logitude = location.getLongitude();
        double latitude = location.getLatitude();

        //textView.setText("Longitude:  "+ logitude+"\n"+"Latitude:  "+latitude +"\n"+"Date:       "+ date+"\n"+"Time:      "+time);

        FirebaseUser user = firebaseAuth.getCurrentUser();// this statement is not creating any problem

        String s1 = user.getEmail().toString();
        String s2 = Double.toString(latitude);
        String s3 = Double.toString(logitude);
        String s4 = date;
        String s5 = time;

        textViewUser.setText("User:     "+user.getEmail());
        textViewtime.setText("Time:     "+time);
        textViewdate.setText("Date:     "+date);
        textViewlat.setText("Latitude: "+latitude);
        textViewlong.setText("Longitude:"+logitude);

        FirebaseDatabase fb = FirebaseDatabase.getInstance();

        dbUsers = fb.getReference();

        String id = dbUsers.push().getKey();

       userLocationDetails  = new UserLocationDetails(s1, s2, s3, s4, s5);

        dbUsers.child(id).setValue(userLocationDetails);


        Toast.makeText(this, "Data uploaded", Toast.LENGTH_SHORT).show();


    }

    @Override
    public void onStatusChanged(String s, int i, Bundle bundle) {

    }

    @Override
    public void onProviderEnabled(String s) {

    }

    @Override
    public void onProviderDisabled(String s) {

    }
}
