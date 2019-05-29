package com.example.projectamazon;

import android.Manifest;
import android.app.KeyguardManager;
import android.content.pm.PackageManager;
import android.hardware.fingerprint.FingerprintManager;
import android.os.Build;
import android.security.keystore.KeyGenParameterSpec;
import android.security.keystore.KeyProperties;
import android.support.annotation.RequiresApi;
import android.support.v4.app.ActivityCompat;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.TextView;
import android.widget.Toast;

import java.io.IOException;
import java.security.InvalidAlgorithmParameterException;
import java.security.InvalidKeyException;
import java.security.KeyStore;
import java.security.KeyStoreException;
import java.security.NoSuchAlgorithmException;
import java.security.NoSuchProviderException;
import java.security.UnrecoverableKeyException;
import java.security.cert.CertificateException;

import javax.crypto.Cipher;
import javax.crypto.KeyGenerator;
import javax.crypto.NoSuchPaddingException;
import javax.crypto.SecretKey;

import static javax.crypto.Cipher.getInstance;

public class ValidateActivity extends AppCompatActivity {

    private KeyStore keyStore;
    public static final String KEY_NAME = "EDMTDev";
    private Cipher cipher;
    private TextView textView;


    @RequiresApi(api = Build.VERSION_CODES.M)
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_validate);


        KeyguardManager keyguardManager = (KeyguardManager)getSystemService(KEYGUARD_SERVICE);
        //deprecated api
        FingerprintManager fingerprintManager =(FingerprintManager)getSystemService(FINGERPRINT_SERVICE);

        if(ActivityCompat.checkSelfPermission(this , Manifest.permission.USE_FINGERPRINT)!= PackageManager.PERMISSION_GRANTED){

            return;
        }

        if(!fingerprintManager.isHardwareDetected()){
            Toast.makeText(this,"Permission not enabled ",Toast.LENGTH_SHORT).show();

        }//end of if
        else{
            if(!fingerprintManager.hasEnrolledFingerprints()){
                Toast.makeText(this, "PLease register your finger print in the device" ,Toast.LENGTH_SHORT).show();

            }//end of inner if
            else{
                if(!keyguardManager.isKeyguardSecure()){
                    Toast.makeText(this,"Lock screen security not enabled",Toast.LENGTH_SHORT).show();
                }//end of inner 2 if
                else{
                    genKey();
                }//end of else 2

                if(cipherInit())
                {
                    FingerprintManager.CryptoObject cryptoObject = new FingerprintManager.CryptoObject(cipher);
                    FingerprintHandler helper = new FingerprintHandler(this);

                    helper.startAuthentication(fingerprintManager , cryptoObject);

                }//end of if 3
            }//end of inner else
        }//end of else
    }

    private boolean cipherInit() {

        try {
            cipher = getInstance(KeyProperties.KEY_ALGORITHM_AES+"/"+KeyProperties.BLOCK_MODE_CBC+"/"+KeyProperties.ENCRYPTION_PADDING_PKCS7);
        } catch (NoSuchAlgorithmException e) {
            e.printStackTrace();
        } catch (NoSuchPaddingException e) {
            e.printStackTrace();
        }

//            keyStore.load(null);
        //           SecretKey key = (SecretKey)keyStore.getKey(KEY_NAME,null);
        try {

            keyStore.load(null);
            SecretKey key = (SecretKey)keyStore.getKey(KEY_NAME,null);
            cipher.init(Cipher.ENCRYPT_MODE,key);
            return true;

        } catch (InvalidKeyException e) {
            e.printStackTrace();
            return false;
        } catch (IOException e){
            e.printStackTrace();
            return false;
        }catch(NoSuchAlgorithmException e){
            e.printStackTrace();
            return false;
        } catch(CertificateException e){
            e.printStackTrace();
            return false;
        }catch (UnrecoverableKeyException e){
            e.printStackTrace();
            return false;
        }catch(KeyStoreException e){
            e.printStackTrace();
            return false;
        }

        //     return true;


    }


    @RequiresApi(api = Build.VERSION_CODES.M)
    private void genKey(){
        try {
            keyStore = KeyStore.getInstance("AndroidKeyStore");
        } catch (KeyStoreException e) {
            e.printStackTrace();
        }

        KeyGenerator keyGenerator = null;

        try {
            keyGenerator = KeyGenerator.getInstance(KeyProperties.KEY_ALGORITHM_AES,"AndroidKeyStore");
        } catch (NoSuchAlgorithmException e) {
            e.printStackTrace();
        } catch (NoSuchProviderException e) {
            e.printStackTrace();
        }

        try {
            keyStore.load(null);
            keyGenerator.init(new KeyGenParameterSpec.Builder(KEY_NAME,KeyProperties.PURPOSE_ENCRYPT | KeyProperties.PURPOSE_DECRYPT).setBlockModes(KeyProperties.BLOCK_MODE_CBC).setUserAuthenticationRequired(true).setEncryptionPaddings(KeyProperties.ENCRYPTION_PADDING_PKCS7).build() );

            keyGenerator.generateKey();


        } catch (CertificateException e) {
            e.printStackTrace();
        } catch (IOException e) {
            e.printStackTrace();
        } catch (NoSuchAlgorithmException e) {
            e.printStackTrace();
        } catch (InvalidAlgorithmParameterException e){
            e.printStackTrace();
        }



        //      keyGenerator.init(new RSAKeyGenParameterSpec().Builder(KEY_NAME,KeyProperties.PURPOSE_ENCRYPT | KeyProperties.PURPOSE_DECRYPT) );
//
    }//end of the method genKey
}



