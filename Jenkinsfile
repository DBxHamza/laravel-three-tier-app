pipeline {
    agent any

    environment {
        IMAGE_NAME = 'laravel-app:1.0'
        KUBECONFIG = '/var/lib/jenkins/.kube/config'
    }

    stages {
        stage('Checkout') {
            steps {
                checkout scm
            }
        }

        stage('Build Docker Image') {
            steps {
                sh 'docker build -t ${IMAGE_NAME} .'
            }
        }

        stage('Load Image into Minikube') {
            steps {
                sh 'docker save ${IMAGE_NAME} | docker exec -i minikube ctr -n k8s.io images import -'
            }
        }

        stage('Deploy to Kubernetes') {
            steps {
                sh 'kubectl apply -f k8s/app.yaml'
                sh 'kubectl rollout status deployment/mysql --timeout=180s'
                sh 'kubectl rollout status deployment/laravel-app --timeout=180s'
            }
        }

        stage('Run Database Migrations') {
            steps {
                sh 'kubectl exec deployment/laravel-app -- php artisan migrate --force'
            }
        }
    }
}
