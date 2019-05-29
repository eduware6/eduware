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
import android.widget.TextView;
import android.widget.Toast;

import com.google.android.gms.tasks.OnCompleteListener;
import com.google.android.gms.tasks.Task;
import com.google.firebase.auth.AuthResult;
import com.google.firebase.auth.FirebaseAuth;

import static android.widget.Toast.LENGTH_SHORT;

public class LoginActivity extends AppCompatActivity  implements View.OnClickListener {

    private Button buttonSignIn;
    private EditText editTextEmail;
    private EditText editTextPassword;
    private TextView textViewSignUp;

    private FirebaseAuth firebaseAuth;

    private ProgressDialog progressDialog; //this gives "uses or overrides depricated api"

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        firebaseAuth = FirebaseAuth.getInstance();
        //here the initialization of view objects

        if(firebaseAuth.getCurrentUser()!=null){
            //user is already logged in
            //go to finger print authentication page
            //temporarily checking with new profile Activity
            finish();
            startActivity(new Intent(getApplicationContext() , ProfileActivity.class));

        }

        buttonSignIn = (Button)findViewById(R.id.buttonSignIn);
        editTextEmail = (EditText)findViewById(R.id.editTextEmail);
        editTextPassword = (EditText)findViewById(R.id.editTextPassword);
        textViewSignUp = (TextView)findViewById(R.id.textViewSignUp);

        progressDialog = new ProgressDialog(this);//depricated api

        //
        //Adding action listener



        buttonSignIn.setOnClickListener(this);
        textViewSignUp.setOnClickListener(this);

    }

    private void userLogin(){

        String email = editTextEmail.getText().toString().trim();
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
        progressDialog.setMessage("Logging In");
        progressDialog.show();
        //this is totally unecessary

        firebaseAuth.signInWithEmailAndPassword(email ,password).addOnCompleteListener(this, new OnCompleteListener<AuthResult>() {
            @Override
            public void onComplete(@NonNull Task<AuthResult> task) {

                progressDialog.dismiss();

                if(task.isSuccessful()){
                    //go to profile activity for test
                    //go to biometric page
                    finish();
                    startActivity(new Intent(getApplicationContext() , ProfileActivity.class));

                }else
                {
                    Toast.makeText(getApplicationContext(),"Login Unsuccesful",LENGTH_SHORT).show();
                }

            }
        });



    }

    @Override
    public void onClick(View view) {
        if(view==buttonSignIn){
            userLogin();

        }

        if(view == textViewSignUp){
            finish();
            startActivity(new Intent(this , MainActivity.class));
        }

    }
}
