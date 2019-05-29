package com.example.projectamazon;

import android.app.ProgressDialog;
import android.content.Intent;
import android.support.annotation.NonNull;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.text.TextUtils;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ProgressBar;
import android.widget.TextView;
import android.widget.Toast;

import com.google.android.gms.tasks.OnCompleteListener;
import com.google.android.gms.tasks.Task;
import com.google.firebase.auth.FirebaseAuth;

import static android.widget.Toast.*;
import com.google.firebase.auth.AuthResult;

public class MainActivity extends AppCompatActivity implements View.OnClickListener {

    private Button buttonRegister;
    private EditText editTextMail;
    private EditText editTextPassword;
    private TextView textViewSignin;

    private ProgressDialog progressDialog;

    private FirebaseAuth firebaseAuth;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        firebaseAuth = FirebaseAuth.getInstance();

        if(firebaseAuth.getCurrentUser()!=null){
            //user is already logged in
            //go to finger print authentication page
            //temporarily checking with new profile Activity
            finish();
            startActivity(new Intent(getApplicationContext() , ProfileActivity.class));

        }


        progressDialog = new ProgressDialog(this);

        buttonRegister = (Button)findViewById(R.id.buttonRegister);
        editTextMail = (EditText)findViewById(R.id.editTextEmail);
        editTextPassword = (EditText)findViewById(R.id.editTextPassword);
        textViewSignin = (TextView)findViewById(R.id.textViewSignin);

        buttonRegister.setOnClickListener(this);
        textViewSignin.setOnClickListener(this);


    }

    private void registerUser(){
        String email = editTextMail.getText().toString().trim();
        String password = editTextPassword.getText().toString().trim();

        if(TextUtils.isEmpty(email)){
            //if email is empty
            Toast.makeText(this,"Please Enter Email ", LENGTH_SHORT).show();
            return;//this prevents the futher execution
        }
        if(TextUtils.isEmpty(password)){
            //password is empty
            Toast.makeText(this,"Please Enter Password ", LENGTH_SHORT).show();
            return;//this prevents the futher execution

        }
        //accepted details
        progressDialog.setMessage("Registration in process");
        progressDialog.show();

        firebaseAuth.createUserWithEmailAndPassword(email,password).addOnCompleteListener(this, new OnCompleteListener<com.google.firebase.auth.AuthResult>() {
            @Override
            public void onComplete(@NonNull Task<com.google.firebase.auth.AuthResult> task) {
                progressDialog.dismiss();

                if(task.isSuccessful()){

                    Toast.makeText(MainActivity.this,"Succesfully Registered", LENGTH_SHORT).show();
                        finish();
                        startActivity(new Intent(getApplicationContext() , ProfileActivity.class));


                }
                else{
                    Toast.makeText(MainActivity.this ,"Could not register try again", LENGTH_SHORT).show();

                }
            }
        });

       // Toast.makeText(this,"Succesfully Registered", LENGTH_SHORT).show();



    }

    //implement methond on click
    @Override
    public void onClick(View view){
        if(view == buttonRegister){
            registerUser();
        }
        if(view == textViewSignin){
            //will open another activity
            finish();

            startActivity(new Intent(this,LoginActivity.class));
        }

    }

}
