package com.example.projectamazon;

import android.Manifest;
import android.annotation.TargetApi;
import android.content.Context;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.hardware.fingerprint.FingerprintManager;
import android.os.Build;
import android.os.CancellationSignal;
import android.support.annotation.RequiresApi;
import android.support.v4.app.ActivityCompat;
import android.widget.Toast;

//@RequiresApi(api = Build.VERSION_CODES.M)
@TargetApi(Build.VERSION_CODES.M)
class FingerprintHandler extends FingerprintManager.AuthenticationCallback{

    private Context context;

    FingerprintHandler(Context context) {
        this.context = context;
    }


    @RequiresApi(api = Build.VERSION_CODES.M)
    public void startAuthentication(FingerprintManager fingerprintManager, FingerprintManager.CryptoObject cryptoObject) {

        CancellationSignal cencancellationSignal = new CancellationSignal();

        if(ActivityCompat.checkSelfPermission(context, Manifest.permission.USE_FINGERPRINT)!= PackageManager.PERMISSION_GRANTED){
            return;

        }

        fingerprintManager.authenticate(cryptoObject,cencancellationSignal,0,this,null);

    }

    @Override
    public void onAuthenticationFailed(){
        super.onAuthenticationFailed();
        Toast.makeText(context , "Finger Print authentication failed " , Toast.LENGTH_SHORT).show();
        context.startActivity(new Intent(context , ProfileActivity.class));

    }

    @Override
    public  void onAuthenticationSucceeded(FingerprintManager.AuthenticationResult result){
        super.onAuthenticationSucceeded(result);
        Toast.makeText(context,"Authentication succesfull" , Toast.LENGTH_SHORT).show();
        context.startActivity(new Intent(context , LocateActivity.class));

    }

}
